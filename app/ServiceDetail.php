<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    //
    protected $table = "sp_product_service_details";
    public $timestamps = false;
    protected $primaryKey = "detailId";
}
