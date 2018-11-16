<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailerProduct extends Model
{
    protected $table = "retailer_product_list";

    public function compare_product(){
        return $this->hasOne('App\CompareProduct','sc_id','sc_ID');
    }
}
