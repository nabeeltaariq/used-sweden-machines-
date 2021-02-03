<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class CustomerProduct extends Model
{
    //
    protected $table = "sp_products_rate";
    public $timestamps = false;
    public function Info(){
        return Service::find($this->productId);
    }
}
