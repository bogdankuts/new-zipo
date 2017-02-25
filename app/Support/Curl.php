<?php
/**
 * Created by PhpStorm.
 * User: BogdanKootz
 * Date: 30.01.17
 * Time: 11:33
 */

namespace App\Support;

class Curl {
	
	private $_method;
	private $_url;
	private $_postData;
	private $_requestHeaders;
	private $_login;
	private $_pass;
	private $_cookieFile;
	
	private $_process;
	private $_response;
	private $_statusCode;
	private $_responseBody;
	
	/**
	 * @var array
	 */
	private $_responseHeaders;
	
	/**
	 * @param string $method
	 * @param string $url
	 * @param string $postData
	 * @param array $headers
	 * @param string $user
	 * @param string $pass
	 * @param string $cookieFile
	 */
	public function __construct($method, $url, $postData = null, array $headers = [], $user = null, $pass = null, $cookieFile = null) {
		$this->_method = strtoupper($method);
		$this->_url = $url;
		$this->_postData = ($postData !== "" && $postData !== "[]") ? $postData : null;
		$this->_requestHeaders = $headers;
		$this->_login = $user;
		$this->_pass = $pass;
		$this->_responseHeaders = [];
		$this->_cookieFile = $cookieFile;
	}
	
	/**
	 * @param int $timeout
	 * @return string
	 */
	public function exec($timeout = 300) {
		$this->_initProcess($timeout);
		$this->_setHeaders();
		$this->_setBasicAuth();
		$this->_setMethod();
		$this->_setPostData();
		$this->_cookieFile();
		$this->_exec();
		
		return $this->_response;
	}
	
	/**
	 * @return string
	 */
	public function response() {
		return $this->_response;
	}
	
	/**
	 * @return int
	 */
	public function statusCode() {
		return $this->_statusCode;
	}
	
	/**
	 * @return string
	 */
	public function postData() {
		return $this->_postData;
	}
	
	/**
	 * @return string
	 */
	public function responseBody() {
		return $this->_responseBody;
	}
	
	/**
	 * @return array
	 */
	public function responseHeaders() {
		return $this->_responseHeaders;
	}
	
	/**
	 * @return string
	 */
	public function url() {
		return $this->_url;
	}
	
	/**
	 * @param int $timeout
	 */
	private function _initProcess($timeout) {
		$this->_process = curl_init($this->_url);
		curl_setopt($this->_process, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($this->_process, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->_process, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($this->_process, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->_process, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($this->_process, CURLOPT_AUTOREFERER, true);
		curl_setopt($this->_process, CURLOPT_MAXREDIRS, 10);
		curl_setopt($this->_process, CURLOPT_HEADERFUNCTION, function ($handle, $data) {
			$this->_responseHeaders[] = $data;
			return mb_strlen($data);
		});
	}
	
	private function _setHeaders() {
		if (count($this->_requestHeaders) === 0) {
			return;
		}
		
		curl_setopt($this->_process, CURLOPT_HEADER, 1);
		curl_setopt($this->_process, CURLINFO_HEADER_OUT, true);
		curl_setopt($this->_process, CURLOPT_HTTPHEADER, $this->_requestHeaders);
	}
	
	private function _setBasicAuth() {
		if (!is_null($this->_login) && !is_null($this->_pass)) {
			curl_setopt($this->_process, CURLOPT_USERPWD, $this->_login . ":" . $this->_pass);
		}
	}
	
	private function _setMethod() {
		curl_setopt($this->_process, CURLOPT_CUSTOMREQUEST, $this->_method);
	}
	
	private function _setPostData() {
		if (!is_null($this->_postData)) {
			curl_setopt($this->_process, CURLOPT_POSTFIELDS, $this->_postData);
		}
	}
	
	private function _cookieFile() {
		if (!is_null($this->_cookieFile)) {
			curl_setopt($this->_process, CURLOPT_COOKIEJAR, $this->_cookieFile);
			curl_setopt($this->_process, CURLOPT_COOKIEFILE, $this->_cookieFile);
		}
	}
	
	private function _exec() {
		$this->_responseHeaders = [];
		$this->_response = curl_exec($this->_process);
		$this->_statusCode = intval(curl_getinfo($this->_process, CURLINFO_HTTP_CODE));
		$headerSize = curl_getinfo($this->_process, CURLINFO_HEADER_SIZE);
		$this->_responseBody = substr($this->_response, $headerSize);
		curl_close($this->_process);
	}
}