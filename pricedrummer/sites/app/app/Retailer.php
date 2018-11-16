<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
	/**
	 * Over-write the default table naming convention.
	 * @var string
	 */
	protected $table = "retailers";

	/**
	 * Disable the created_at and updated_at column.
	 * @var bool
	 */
	public $timestamps = false;
}
