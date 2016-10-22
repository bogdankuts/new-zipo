<?php

namespace App\Http\Controllers;

use App\Item;
use App\Pdf;
use App\Producer;
use Illuminate\Http\Request;

use App\Http\Requests;

class PdfController extends Controller {

	public function allPdf() {

		return view('user-interface.pdf-all')->with([
			'producers'     => Producer::getPdfProducersByCategory(),
			'categories'    => $this->createCategories()
		]);
	}

	public function allPdfByProducer($category) {
		$producer = Producer::find(request()->get('producer_id'));

		return view('user-interface.pdf-by-producer')->with([
			'producer'  => $producer,
			'category'  => $category,
		    'pdfs'      => Pdf::allByCategoryAndProducer($category,$producer->producer_id)
		]);
	}

	public function allPdfByCategory($category) {

		return view('user-interface.pdf-by-category')->with([
			'category'  => $category,
			'pdfs'      => Pdf::allByCategory($category)
		]);
	}

	public function onePdf($category) {
		$fileId = request()->get('pdf_id');
		$file = Pdf::find($fileId);
		$fileType = substr($file['file'], 0, 3);

		return view('user-interface.pdf-one')->with([
			'producer'	=> Producer::find(request()->get('producer_id')),
			'pdf'		=> $file,
			'file_type' => $fileType,
			'category' => $category,
			'items'		=> Item::getItemsForPdf($fileId)
		]);
	}
}
