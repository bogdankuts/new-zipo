<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Feedback extends Mailable {
    use Queueable, SerializesModels;

	private $feedbackData;

	/**
	 * Create a new message instance.
	 *
	 * @param array $data
	 */
    public function __construct(array $data = []) {
	    $formedData = $this->formMailData($data);
	    $this->feedbackData = $formedData;
    }

	private function formMailData($data) {
		if($data['company'] === '') {
			$data['company'] = 'Не указана';
		}
		if($data['phone'] === '') {
			$data['phone'] = 'Не указан';
		}
		if($data['theme'] === '') {
			$data['theme'] = 'Нет темы';
		}

		return $data;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('emails.feedback')
	                ->subject("Обратная связь от ". $this->feedbackData['name'])
	                ->with([
		               'name'       => $this->feedbackData['name'],
		               'company'    => $this->feedbackData['company'],
		               'phone'      => $this->feedbackData['phone'],
		               'email'      => $this->feedbackData['email'],
		               'theme'      => $this->feedbackData['theme'],
		               'body'       => $this->feedbackData['body'],
	                ]);
    }
}
