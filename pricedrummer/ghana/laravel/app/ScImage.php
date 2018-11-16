<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScImage extends Model
{
	/**
	 * Specify the primary_key column for the table.
	 * @var string
	 */
	protected $primaryKey = "image_ID";

	/**
	 * Over-write the default table naming convention.
	 * @var string
	 */
	protected $table = "sc_images";

	/**
	 * Disable the created_at and updated_at column.
	 * @var bool
	 */
	public $timestamps = false;
}
