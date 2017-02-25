<?php

/**
 * Created by PhpStorm.
 * User: BogdanKootz
 * Date: 30.01.17
 * Time: 11:24
 */
namespace App\Support;

use App\Setting;

class SMS {
	
	protected $login = 'z1415353853918';
	protected $password = '677463';
	protected $SMSText;
	
	protected $credString;
	
	public function __construct($orderId) {
		$this->credString = "?login=$this->login&password=$this->password";
		$this->SMSText = mb_convert_encoding("Заказ $orderId оформлен тел.".Setting::getPhones()[0]->value." Ответ поступит к вам на E-Mail.", "UTF-8");
	}
	
	
	public function checkAccount() {
		$curl = new Curl('get', "http://api.iqsms.ru/messages/v2/balance/$this->credString");
		$curl->exec();
		$result = intval(substr(substr($curl->response(), 4), 0, 4));
		if($result > 0) {
			
			return true;
		} else {
			
			return false;
		}
	}
	
	public function getSenders() {
		$curl = new Curl('get', "http://gate.iqsms.ru/senders/$this->credString");
		$curl->exec();
		$resultStr = $curl->response();
		
		return explode("\n", $resultStr);
	}
	
	public function sendSMS($number) {
		//dd($this->SMSText);
		if ($this->numberIsValid($number)) {
			dd(str_replace([' ', '-', ')', '('], '', $number));
			
			$curl = new Curl('get', "http://gate.iqsms.ru/send/$this->credString&phone=$number&text=$this->SMSText");
			dd($curl);
			//$curl->exec();
		} else {
			dd('shiit');
		}
	}
	
	private function numberIsValid($number) {
		$code = substr($number, 0, 2);
		if ($code == '+7') {
			
			return true;
		} else {
			
			return false;
		}
	}
	
	private function formSMSText($orderId, $fullName) {
		
		return 'Уважаемый '.$fullName.', Ваш заказ номер '.$orderId.' оформлен. Хорошего дня!';
	}
	
	//public static function send($host, $port, $login, $password, $phone, $text, $sender = false, $wapurl = false) {
	//	$fp = fsockopen($host, $port, $errno, $errstr);
	//	if (!$fp) {
	//		return "errno: $errno \nerrstr: $errstr\n";
	//	}
	//	fwrite($fp, "GET /send/" . "?phone=" . rawurlencode($phone) . "&text=" . rawurlencode($text) . ($sender ? "&sender=" . rawurlencode($sender) : "") . ($wapurl ? "&wapurl=" . rawurlencode($wapurl) : "") . "  HTTP/1.0\n");
	//	fwrite($fp, "Host: " . $host . "\r\n");
	//	if ($login != "") {
	//		fwrite($fp, "Authorization: Basic " . base64_encode($login . ":" . $password) . "\n");
	//	}
	//	fwrite($fp, "\n");
	//	$response = "";
	//	while (!feof($fp)) {
	//		$response .= fread($fp, 1);
	//	}
	//	fclose($fp);
	//	list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
	//
	//	return $responseBody;
	//}
	//
	////echo send("gate.iqsms.ru", 80, "api_login", "api_password", "71234567890", "text here", "iqsms", "wap.yousite.ru");
	//
	//
	//public static function status($host, $port, $login, $password, $sms_id) {
	//	$fp = fsockopen($host, $port, $errno, $errstr);
	//	if (!$fp) {
	//		return "errno: $errno \nerrstr: $errstr\n";
	//	}
	//	fwrite($fp, "GET /status/" . "?id=" . $sms_id . "  HTTP/1.0\n");
	//	fwrite($fp, "Host: " . $host . "\r\n");
	//	if ($login != "") {
	//		fwrite($fp, "Authorization: Basic " . base64_encode($login . ":" . $password) . "\n");
	//	}
	//	fwrite($fp, "\n");
	//	$response = "";
	//	while (!feof($fp)) {
	//		$response .= fread($fp, 1);
	//	}
	//	fclose($fp);
	//	list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
	//
	//	return $responseBody;
	//}
	////echo status("gate.iqsms.ru", 80, "api_login", "api_password", "12345");
	
}