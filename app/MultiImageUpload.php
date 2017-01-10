<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class MultiImageUpload extends Model {

	protected $table = "item_photos";
	public $primaryKey = 'id';
	public $timestamps = false;
	public $fillable = ['item_id', 'photo_title'];

	public static function upload($file) {
		$fileName = $file->getClientOriginalName();

		\Storage::putFileAs('img/photos/items/temp', $file, $fileName);
		MultiImageUpload::addWatermark($fileName);

		return $fileName;
	}

	public static function addWatermark($filename) {
		$watermark_path = public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'watermark.png';
		$watermark = Image::make($watermark_path);
		$image = Image::make('img/photos/items/temp'.DIRECTORY_SEPARATOR.$filename);

		// resize watermark TODO::abstract this part?
		$width = $image->width();
		$height = $image->height();
		$watermark->fit($width, $height);

		$image->insert($watermark, 'center', 0, 0);
		$image->save();
	}

	public static function storeDB($originalName, $item_id) {
		$newFileName = time().str_replace('img/photos/items/temp/', '', $originalName);
		\Storage::move($originalName, '/img/photos/items/'.$item_id.'/'.$newFileName);

		MultiImageUpload::create([
			'item_id'       => $item_id,
		    'photo_title'   => $newFileName,
		]);

	}

	public static function clearFolder() {
		$files = \Storage::allFiles('img/photos/items/temp');
		foreach ($files as $file) {
			\Storage::delete($file);
		}
	}

	public static function deletePhoto($photo) {
		\Storage::delete('img/photos/items/temp/'.$photo);
	}

	public static function deleteExistingPhoto($itemId, $photo) {

		\Storage::delete('img/photos/items/'.$itemId.'/'.$photo);
		MultiImageUpload::where('item_id', $itemId)->where('photo_title', $photo)->delete();
	}

	public static function deleteAllPhotosByItemId($itemId) {
		\Storage::deleteDirectory('img/photos/items/'.$itemId);
		MultiImageUpload::where('item_id', $itemId)->delete();

	}
}
