<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
	/**
	 * Specify the primary_key column for the table.
	 * @var string
	 */
//	protected $primaryKey = "category_details_ID";

	/**
	 * Over-write the default table naming convention.
	 * @var string
	 */
	protected $table = "category_detail_filter_table";

	/**
	 * Disable the created_at and updated_at column.
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * A category detail belongs to a single category.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo( 'App\Category' );
	}
}
