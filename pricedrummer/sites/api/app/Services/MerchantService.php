<?php

namespace App\Services;

use App\Merchant;


class MerchantService
{
	public function getMerchants()
	{
		return $this->filterMerchant( Merchant::all() );
	}

	public function filterMerchant($merchants)
	{
		$data = [];
		foreach ( $merchants as $merchant ) {
			$merchant_entry = [
				'merchant_id'      => $merchant->merchant_ID,
				'name'             => $merchant->name,
				'url'              => $merchant->url,
				'rating'           => $merchant->rating,
				'posted_timestamp' => $merchant->posted_timestamp
			];

			$data[] = $merchant_entry;
		}

		return $data;
	}
}


?>