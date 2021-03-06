<?php

namespace App\Mail;

use App\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminOrder extends Mailable
{
    use Queueable, SerializesModels;

	private $order;

	private $items;

	private $file = '';

	private $orderId;

	private $payment;

	private $discount = 0;

	/**
	 * Create a new message instance.
	 *
	 * @param array $data
	 * @param array $items
	 * @param int   $orderId
	 */
    public function __construct(array $data, array $items, $orderId)
    {
	    $this->formDiscount($data);
	    $this->formPayment($data['payment']);
	    $this->items = $items;
	    $this->countOrderSum();
	    $this->orderId = $orderId;
	    $this->order = $this->formDelivery($data);

	    if(array_key_exists('requisites', $data)) {
		    $this->file = $data['requisites'];
	    }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    if ($this->file != '') {
		    return $this->view('emails.order-admin')
		                ->subject("Заказ № $this->orderId  - vsezip.ru")
		                ->with([
			                'order'     => $this->order,
			                'items'     => $this->items,
			                'orderId'   => $this->orderId,
			                'discount'  => $this->discount,
			                'payment'   => $this->payment
		                ])
			            ->attach(public_path().DIRECTORY_SEPARATOR.'requisites'.DIRECTORY_SEPARATOR.$this->file);
	    } else {
		    return $this->view('emails.order-admin')
		                ->subject("Заказ № $this->orderId  - vsezip.ru")
		                ->with([
			                'order'     => $this->order,
			                'items'     => $this->items,
			                'orderId'   => $this->orderId,
		                    'discount'  => $this->discount,
		                    'payment'   => $this->payment
		                ]);
	    }
    }

	/**
	 * Set payment variable and discount
	 *
	 * @param $payment
	 */
	private function formPayment($payment) {
		switch ($payment) {
			case 'card':
				$this->payment = 'Оплата на карту Сбербанка';
				$this->discount = Setting::getDiscountCard();
				break;
			case 'check':
				$this->payment = 'Оплата по счету(юр. лица)';
				break;
			case 'physic_check':
				$this->payment = 'Оплата по счету(физ. лица)';
				break;
		}
	}

	/**
	 * Set discount value
	 * @param string $registered
	 */
	private function formDiscount($data) {
		$discountReg = 0;
		$discountPay = 0;
		if ($data['registered'] != 0) {
			$discountReg = Setting::getDiscount();
		}
		if($data['payment'] == 'card') {
			$discountPay = Setting::getDiscountCard();
		}
		
		$this->discount = max($discountPay, $discountReg);
	}

	/**
	 * Form delivery for order email
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	private function formDelivery(array $data) {
		switch ($data['delivery']) {
			case 'self':
				$data['deliveryNormal'] = 'Самовывоз';
				$data['deliveryPrice'] = 0;
				break;
			case 'St.Petersburg_delivery':
				$data['deliveryNormal'] = 'Доставка По Санкт Петербургу';
				if($this->order['sum'] > 20000) {
					$data['deliveryPrice'] = 0;
				} else {
					$data['deliveryPrice'] = 350;
				}
				break;
			case 'TK_business_lines':
				$data['deliveryNormal'] = 'Доставка до терминала ТК Деловые Линии в Санкт Петербурге';
				if($this->order['sum'] > 20000) {
					$data['deliveryPrice'] = 0;
				} else {
					$data['deliveryPrice'] = 150;
				}
				break;
			case 'EMC':
				$data['deliveryNormal'] = 'Доставка EMC до адреса получателя.';
				$data['deliveryPrice'] = 9999;
				break;
			case 'SDEK':
				$data['deliveryNormal'] = 'Доставка экспресс почтой СДЭК до адреса получателя.';
				$data['deliveryPrice'] = 0;
				break;
			case 'RATEK':
				$data['deliveryNormal'] = 'Доставка до терминала ТК РАТЭК в Санкт Петербурге.';
				if($this->order['sum'] > 20000) {
					$data['deliveryPrice'] = 0;
				} else {
					$data['deliveryPrice'] = 150;
				}
				break;
			case 'PONY':
				$data['deliveryNormal'] = 'Доставка экспресс почтой Pony express до адреса получателя.';
				$data['deliveryPrice'] = 0;
				break;
			case 'Dimex':
				$data['deliveryNormal'] = 'Доставка экспресс почтой dimex до адреса получателя.';
				$data['deliveryPrice'] = 9999;
				break;
			case 'PEK':
				$data['deliveryNormal'] = 'Доставка до терминала  ПЭК в Санкт Петербурге.';
				if($this->order['sum'] > 20000) {
					$data['deliveryPrice'] = 0;
				} else {
					$data['deliveryPrice'] = 200;
				}
				break;
			case 'MSK':
				$data['deliveryNormal'] = 'Доставка в Москву (в МКАД) Элайн  экспресс. (1 рабочий день).';
				$data['deliveryPrice'] = 9999;
				break;
			case 'Other':
				$data['deliveryNormal'] = 'Другое';
				$data['deliveryPrice'] = 9999;
				break;
		}
		$data['sum'] = $this->order['sum'];
		return $data;
	}

	/**
	 * Count order sum
	 */
	private function countOrderSum() {
		$sum = 0;
		foreach ($this->items as $item) {
			$sum += $item->price*$item->count;
		}
		
		$this->order['sum'] = $sum;
	}

}
