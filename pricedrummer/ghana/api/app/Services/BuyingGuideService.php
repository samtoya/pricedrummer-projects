<?php

namespace App\Services;

use App\BuyingGuide;

class BuyingGuideService
{
	public function getGuides()
	{
		return $this->filterGuides( BuyingGuide::paginate() );
	}

	public function filterGuides($guides)
	{
		$data = [];
		foreach ( $guides as $guide ) {
			$guide_entry = [
				'id'               => $guide->id,
				'heading'          => $guide->heading,
				'content'          => $guide->content,
				'has_image'        => $guide->has_image,
				'category_id'      => $guide->category_id,
				'posted_timestamp' => $guide->posted_timestamp
			];

			$data[] = $guide_entry;
		}

		return $data;
	}
}