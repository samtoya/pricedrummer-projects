<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * Specify the primary_key column for the table.
	 * @var string
	 */
	protected $primaryKey = "category_ID";

	/**
	 * Over-write the default table naming convention.
	 * @var string
	 */
	protected $table = "category";

	/**
	 * Disable the created_at and updated_at column.
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Category constructor.
	 */
	public function __construct()
	{
//		$this->middleware('jwt:auth');
	}
	
	/**
	 * A category has many category details.
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function category_detail()
	{
		return $this->hasMany( 'App\CategoryDetail', 'category_ID' );
	}
}
