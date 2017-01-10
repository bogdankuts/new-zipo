<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdf extends Model {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'pdf_id';

	public function producer() {
		return $this->hasOne(Producer::class, 'producer_id', 'producer_id');
	}

	public function subcat() {
		return $this->hasOne(Subcat::class, 'subcat_id', 'subcat_id');
	}

	public function items() {
		return $this->belongsToMany(Item::class); // optional second argument is pivot table name
	}

	/**
	 * Get pdf files by producer
	 *
	 * @param int $producerId
	 *
	 * @return mixed
	 */
	public static function allByProducer($producerId) {

		return Pdf::with(['producer', 'subcat'])
		           ->where('producer_id', $producerId)
		           ->orderBy('good', 'asc')
		           ->get();
	}

	/**
	 * Get all pdf files by category
	 *
	 * @param string $category
	 *
	 * @return mixed
	 */
	public static function allByCategory($category) {
		return Pdf::with(['producer', 'subcat'])
		          ->whereHas('subcat', function($query) use($category) {
			          return $query->where('category', unSlug($category));
		          })
		          ->orderBy('good', 'asc')
		          ->get();
	}
	
	public static function allByProducerSubcat($subcat, $producer) {
		
		return Pdf::with(['producer', 'subcat'])
		          ->where('subcat_id', $subcat)
				  ->where('producer_id', $producer)
		          ->orderBy('good', 'asc')
		          ->get();
	}

	/**
	 * Get all pdf files by category and producer
	 *
	 * @param string    $category
	 * @param int       $producerId
	 *
	 * @return mixed
	 */
	public static function allByCategoryAndProducer($category, $producerId) {
		return Pdf::with(['producer', 'subcat'])
		    ->where('producer_id', $producerId)
			->whereHas('subcat', function($query) use($category) {
				return $query->where('category', unSlug($category));
			})
		    ->orderBy('good', 'asc')
			->get();
	}

	/**
	 * Remove producer id from pdf
	 * @param int $producerId
	 */
	public static function deleteProducerFromPdfs($producerId) {

		Pdf::where('producer_id', $producerId)->update(['producer_id' => 0]);
	}

	public static function allPdf() {

		return Pdf::with('producer')
		          ->with('subcat')
		          ->orderBy('pdf_id', 'desc')
			      //->take(1)
			      ->get();
			      //->paginate(40);

	}

	public static function getPdf($pdfId) {

		return Pdf::join('subcats', 'subcats.subcat_id', '=', 'pdfs.subcat_id')
		          ->join('producers', 'producers.producer_id', '=', 'pdfs.producer_id')
				  ->find($pdfId);
	}

	public static function deletePdf($id) {
		$pdf = Pdf::find($id);
		\DB::table('item_pdf')
		   ->where('pdf_id', $id)
		   ->delete();
		\Storage::delete("pdf/".$pdf->file);
		$pdf->delete();
	}
	
	public static function resetSubcategory($subcatId) {
		Pdf::where('subcat_id', $subcatId)->update(['subcat_id' => 0]);
	}
}
