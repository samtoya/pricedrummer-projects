<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sc extends Model
{
	/**
	 * Specify the primary_key column for the table.
	 * @var string
	 */
	protected $primaryKey = "sc_ID";

	/**
	 * Over-write the default table naming convention.
	 * @var string
	 */
	protected $table = "sc";

	/**
	 * Disable the created_at and updated_at column.
	 * @var bool
	 */
	public $timestamps = false;

	public function sc_detail()
	{
		return $this->hasMany( 'App\ScDetail', 'product_ID' );
	}
}
