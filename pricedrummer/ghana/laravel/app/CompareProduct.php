<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompareProduct extends Model
{
    protected $table = "compare_products";

	public function product_compare_specs()
	{
		return $this->hasMany( 'App\ScDetail', 'product_ID', 'sc_id' );
	}
}
