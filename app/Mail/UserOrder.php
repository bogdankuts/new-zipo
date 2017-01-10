<?php

namespace App\Mail;

use App\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserOrder extends Mailable
{
    use Queueable, SerializesModels;

	private $order;

	private $items;

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
	    $this->formDiscount($data['registered']);
	    $this->formPayment($data['payment']);
	    $this->items = $items;
	    $this->countOrderSum();
	    $this->orderId = $orderId;
	    $this->order = $this->formDelivery($data);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    return $this->view('emails.order-user')
	                ->subject("Заказ оформлен - vsezip.ru")
                    ->with([
	                    'order'     => $this->order,
	                    'items'     => $this->items,
	                    'orderId'   => $this->orderId,
	                    'discount'  => $this->discount,
	                    'payment'   => $this->payment

                    ]);
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
				break;
			case 'St.Petersburg_delivery':
				$data['deliveryNormal'] = 'Доставка По Санкт Петербургу';
				break;
			case 'TK_business_lines':
				$data['deliveryNormal'] = 'Доставка до терминала ТК Деловые Линии в Санкт Петербурге';
				break;
			case 'EMC':
				$data['deliveryNormal'] = 'Доставка EMC до адреса получателя.';
				break;
			case 'SDEK':
				$data['deliveryNormal'] = 'Доставка экспресс почтой СДЭК до адреса получателя.';
				break;
			case 'RATEK':
				$data['deliveryNormal'] = 'Доставка до терминала ТК РАТЭК в Санкт Петербурге.';
				break;
			case 'PONY':
				$data['deliveryNormal'] = 'Доставка экспресс почтой Pony express до адреса получателя.';
				break;
			case 'Dimex':
				$data['deliveryNormal'] = 'Доставка экспресс почтой dimex до адреса получателя.';
				break;
			case 'PEK':
				$data['deliveryNormal'] = 'Доставка до терминала  ПЭК в Санкт Петербурге.';
				break;
			case 'MSK':
				$data['deliveryNormal'] = 'Доставка в Москву (в МКАД) Элайн  экспресс. (1 рабочий день).';
				break;
			case 'Other':
				$data['deliveryNormal'] = 'Другое';
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

	/**
	 * Set discount value
	 * @param string $registered
	 */
	private function formDiscount($registered) {
		if ($registered != 0) {
			$this->discount = Setting::getDiscount();
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
}
