<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Catagories extends Model
{
    protected $primaryKey = 'id';
    protected $table = "sp_categories";
    public $timestamps = false;
    public function Product(){
        return $this->hasMany('App\Product','fk_cat_id');
    }

    public static function getAllMachinesCount(){
        $allCatagories = Catagories::all();
        $total = 0;
        foreach($allCatagories as $cat){
            $totalProducts = Product::where("cat_id",$cat->id)->count();
            $total += $totalProducts;
        }
        return $total;
    }

    public static function ListWithTotal(){
        $allCatagories = Catagories::all();
        $list = [];
        foreach($allCatagories as $cat){
            $totalProducts = Product::where("cat_id",$cat->id)->count();
            $data = ["name" => $cat->name,"totalProducts" => $totalProducts,"id" => $cat->id];
            array_push($list,$data);
        }
        return $list;
    }

}
