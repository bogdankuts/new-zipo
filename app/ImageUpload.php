<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class ImageUpload extends Model {
	private $type = 'item';
	private $path;

	public function __construct(array $attributes=[]) {
		parent::__construct($attributes);
		$this->defineType();
		$this->getPath();
	}

	/**
	 * Set type variable depending on route name
	 */
	private function defineType() {
		$route = \Request::route()->getName();
		switch ($route) {
			case 'ajax_image_article':
				$this->type = 'article';
				break;
			case 'save_article':
				$this->type = 'article';
				break;
			case 'article_update':
				$this->type = 'article';
				break;
			case 'ajax_image':
				$this->type = 'item';
				break;
			case 'save_item':
				$this->type = 'item';
				break;
			case 'change_item':
				$this->type = 'item';
				break;
			case 'ajax_image_producer':
				$this->type = 'producer';
				break;
			case 'producer_save':
				$this->type = 'producer';
				break;
			case 'producer_update':
				$this->type = 'producer';
				break;
		}
	}

	/**
	 * Set path variable depending on type
	 */
	private function getPath() {
		if($this->type == 'article') {
			$this->path = public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'articles';
		} elseif($this->type == 'item') {
			$this->path = public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'items';
		} else {
			$this->path = public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'producers';
		}
	}


	/**
	 * Process photo(upload or delete)
	 *
	 * @param string $photo
	 * @param string $oldPhoto
	 *
	 * @return string
	 */
	public function processPhoto($photo, $oldPhoto) {
		$type = $this->checkPhotoType($photo, $oldPhoto);


		if ($type === 'no') {

			return 'no_photo.png';

		} elseif ($type === 'deleted') {

			return $this->deletePhoto($oldPhoto);

		} elseif ($type === 'same') {

			return $oldPhoto;

		} elseif ($type === 'new_deleted') {
			$this->deletePhoto($oldPhoto);

			return $this->uploadPhoto($photo);

		} elseif ($type === 'new') {

			return $this->uploadPhoto($photo);

		}
	}

	/**
	 * @param $photo
	 *
	 * @return string
	 */
	public function deletePhoto($photo) {
		if($this->type == 'article') {
			(\Storage::delete('img/photos/articles/'.$photo));
		} else {
			\Storage::delete('img/photos/items/'.$photo);
		}

		return 'no_photo.png';
	}

	//TODO::replace this function
	/**
	 * Add photo to temp directory on server and create the preview response
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function ajaxImage() {
		if (request()->hasFile('ajax_photo')) {
			$file = request()->file('ajax_photo');
			$destinationPath = $this->path;
			$extension = $file->getClientOriginalExtension();

			$filename = 'temp.'.$extension;
			$file->move($destinationPath, $filename);

			$this->addWatermark($filename);
		}

		return response()->json($filename);
	}

	/**
	 * Get the type of photo
	 *
	 * @param string $photo
	 * @param string $oldPhoto
	 *
	 * @return string
	 */
	private function checkPhotoType($photo, $oldPhoto) {
		if ($photo == 'no_photo.png') {
			if ($oldPhoto == 'no_photo.png') {
				$type = 'no';
			} else {
				$type = 'deleted';
			}
		} else {
			if ($photo == $oldPhoto) {
				$type = 'same';
			} else {
				if ($oldPhoto != 'no_photo.png') {
					$type = 'new_deleted';
				} else {
					$type = 'new';
				}
			}
		}

		return $type;
	}

	/**
	 * Upload photo
	 *
	 * @param string $photo
	 *
	 * @return string
	 */
	private function uploadPhoto($photo) {
		$temp = $this->path.DIRECTORY_SEPARATOR.$photo;
		$extension = \File::extension($temp);
		$filename = 'photo_'.time().'.'.$extension;
		$new = $this->path.DIRECTORY_SEPARATOR.$filename;
		rename($temp, $new);

		return $filename;
	}

	//TODO::replace this function
	/**
	 * Add watermark to image
	 * @param string $filename
	 */
	private function addWatermark($filename) {
		$watermark_path = public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'photos'.DIRECTORY_SEPARATOR.'watermark.png';
		$watermark = Image::make($watermark_path);
		$image = Image::make($this->path.DIRECTORY_SEPARATOR.$filename);

		// resize watermark TODO::abstract this part?
		$width = $image->width();
		$height = $image->height();
		$watermark->fit($width, $height);

		$image->insert($watermark, 'center', 0, 0);
		$image->save();
	}
}
