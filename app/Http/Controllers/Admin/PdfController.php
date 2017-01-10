<?php

namespace App\Http\Controllers\Admin;

use App\Pdf;
use App\Producer;
use App\Subcat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PdfSaveRequest;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PdfController extends Controller {

	public function ajaxChangePdf() {
		$ids = request()->get('ids');
		$pdf_id = request()->get('pdf_id');
		$pdf_items = Pdf::find($pdf_id)->items();
		$itemIds = Pdf::find($pdf_id)->items->pluck('item_id');

		foreach ($itemIds as $itemId) {
			if (in_array($itemId, $ids)) {
				$attached_ids[] = $itemId;
			}
		}

		$pdf_items->attach($ids);
		if (isset($attached_ids)) {
			$pdf_items->detach($attached_ids);
		}

		return response()->json($ids);
	}

	public function pdfs() {
		
		return view('admin.pdfs.pdfs')->with([
			'pdfs' => Pdf::allPdf(),
		]);
	}

	public function change($id) {

		return view('admin.pdfs.change')->with([
			'pdf'	    => Pdf::getPdf($id),
			'producers' => Producer::all(),
		]);
	}

	public function create() {

		return view('admin.pdfs.add')->with([
			'pdf'	    => Pdf::getPdf(request()->get('pdf_id')),
			'producers' => Producer::all(),
		]);
	}

	public function save(PdfSaveRequest $request) {
		if ($request->hasFile('file')) {
			$file = $request->file;
			$extension = $file->getClientOriginalExtension();
			$isAllowed = $this->checkPdfExtension($extension);
			if (!$isAllowed) {

				return redirect()->route('create_pdf')->withInput()->withErrors(
					"Выбранный файл должен иметь формат	'.pdf', '.doc', '.docx', '.jpg', '.jpeg', '.png', '.xls', или '.xlsx'"
				);
			}
			$type = $this->getFileType($extension);
			$fileName = $this->createPdfFileName($type, $extension);
			$fields = $this->formPdfFields($fileName);
			
			\Storage::putFileAs('pdf', $file, $fileName);
			
			if ($type == 'img') {
				$this->addWatermarkPdf($fileName);
			}

			Pdf::create($fields);

			return redirect()->route('create_pdf')->with('message', 'Деталировка успешно загружена!');

		} else {

			return redirect()->route('create_pdf')->withErrors('Деталировка не выбрана!');
		}
	}

	public function update($id) {
		$fields = request()->all();
		unset($fields['subcategoryActive']);
		unset($fields['categoryActive']);
		unset($fields['category']);

		Pdf::find($id)->update($fields);

		return redirect()->back()->with('message', 'Деталировка изменена успешно.');
	}

	public function delete($id) {

		Pdf::deletePdf($id);

		if(request()->ajax()) {

			return true;
		}

		return redirect()->route('admin_pdfs')->with('message', 'Деталировка успешно удалена!');

	}

	/**
	 * Add watermark to image if needed
	 *
	 * @param string $fileName
	 */
	private function addWatermarkPdf($fileName) {
		$watermark_path = public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'watermark.png';
		$watermark = Image::make($watermark_path);
		$image = Image::make(public_path().DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.$fileName);
		
		// resize watermark
		$width = $image->width();
		$height = $image->height();
		$watermark->fit($width, $height);

		$image->insert($watermark, 'center', 0, 0);
		$image->save();
	}

	/**
	 * Ckeck if file has allowed format
	 *
	 * @param $extension
	 *
	 * @return $this
	 */
	private function checkPdfExtension($extension) {
		$allowed_extensions = ['pdf', 'PDF', 'doc', 'DOC', 'docx', 'DOCX', 'jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'xls', 'XLS', 'xlsx', 'XLSX'];
		if (!in_array($extension, $allowed_extensions)) {

			return false;
		}

		return true;
	}

	/**
	 * Get file type
	 *
	 * @param string $extension
	 *
	 * @return string
	 */
	private function getFileType($extension) {
		if ($extension == 'pdf' || $extension == 'PDF') {
			$type = 'pdf';
		} elseif ($extension == 'doc' || $extension == 'DOC' || $extension == 'docx' || $extension == 'DOCX') {
			$type = 'doc';
		} elseif ($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'png' || $extension == 'PNG') {
			$type = 'img';
		} elseif ($extension == 'xsl' || $extension == 'XLS' || $extension == 'xlsx' || $extension == 'XLSX') {
			$type = 'tbl';
		} else {
			$type = 'ukf';
		}

		return $type;
	}

	/**
	 * Create name of file based on type and current time
	 *
	 * @param string $type
	 * @param string $extension
	 *
	 * @return string
	 */
	private function createPdfFileName($type, $extension) {

		return $type.'_'.time().'.'.$extension;
	}

	/**
	 * Form the fields array to create item
	 *
	 * @param string $fileName
	 *
	 * @return array
	 */
	private function formPdfFields($fileName) {
		$fields = array_map('trim', request()->all());
		unset($fields['category']);
		unset($fields['subcategoryActive']);
		unset($fields['categoryActive']);
		$fields['file'] = $fileName;

		return $fields;
	}
}
