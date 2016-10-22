<?php

namespace App\Http\Controllers\Admin;

use App\ImageUpload;
use App\Pdf;
use App\Producer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProducersController extends Controller {

	public function producers() {

		return view('admin.producers.producers')->with([
			'producers' => Producer::readAllProducers(),
		]);
	}

	public function add() {

		return view('admin.producers.add')->with([
			'producer'	=> Producer::find(request()->get('producer_id')),
		]);
	}

	public function change($id) {

		return view('admin.producers.change')->with([
			'producer'	=> Producer::find($id),
		]);
	}

	public function delete($id) {
		$producer = Producer::find($id);
		$imageUpload = new ImageUpload();

		Pdf::deleteProducerFromPdfs($id);
		Producer::deleteProducerFromItems($id);

		if ($producer->producer_photo != 'no_photo.png') {
			$imageUpload->deletePhoto($producer->producer_photo);
		}

		$producer->delete();

		return redirect()->route('admin_producers')->with('message', 'Производитель успешно удален!');
	}

	public function save() {
		$fields = request()->all();

		$producer = $this->createProducer($fields);

		$message = 'Производитель '.$producer->producer.' добавлен! <a href='.route('producer_change', [$producer->producer_id]).' class="alert-link">Назад</a>';

		return redirect()->back()->with('message', $message);

	}

	public function update($id) {
		$fields = request()->all();

		$producer = $this->updateProducer($fields, $id);

		$message = 'Производитель '.$producer->producer.' изменен! <a href='.route('producer_change', [$producer->producer_id]).' class="alert-link">Назад</a>';

		return redirect()->back()->with('message', $message);

	}

	public function ajaxProducerImage() {
		$imageUpload = new ImageUpload();

		return $imageUpload->ajaxImage();
	}

	private function createProducer($fields) {
		$imageUpload = new ImageUpload();
		$fields['photo'] = $imageUpload->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);
		$fields['producer_photo'] = $fields['photo'];
		unset($fields['photo']);

		return $producer = Producer::create($fields);
	}

	private function updateProducer($fields, $producerId) {
		$imageUpload = new ImageUpload();
		$fields['photo'] = $imageUpload->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);
		$fields['producer_photo'] = $fields['photo'];
		unset($fields['photo']);

		$producer = Producer::find($producerId);
		$producer->update($fields);

		return $producer;
	}
}
