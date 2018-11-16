<?php

namespace App\Services;

use App\ScImage;

class ScImageService
{
	public function getScImages()
	{
		return $this->filterScImages( ScImage::select('image_ID', 'product_ID')->get() );
	}

	private function filterScImages($sc_images)
	{
		$data = [];
		foreach ( $sc_images as $sc_image ) {
			$sc_image_entry = [
				'product_id' => $sc_image->product_ID,
				'image_id'   => $sc_image->image_ID,
			];

			$data[] = $sc_image_entry;
		}

		return $data;
	}
}