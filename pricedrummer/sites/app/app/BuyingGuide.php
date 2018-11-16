<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyingGuide extends Model
{
	/**
	 * Over-write the default table naming convention.
	 * @var string
	 */
    protected $table = "buying_guide";

	/**
	 * Disable the created_at and updated_at column.
	 * @var bool
	 */
	public $timestamps = false;
}
