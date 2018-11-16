<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScDetail extends Model
{
	/**
	 * Over-write the default table naming convention.
	 * @var string
	 */
	protected $table = "sc_details";

	/**
	 * Disable the created_at and updated_at column.
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * A standard catalogue details belongs to a product.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function sc()
	{
		return $this->belongsTo( 'App\Sc', 'product_ID' );
	}
	public function productCompare_detail()
	{
		return $this->belongsTo( 'App\CompareProduct', 'product_ID' );
	}


}
