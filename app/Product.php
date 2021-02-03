<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Thumbs;
use Illuminate\Http\Request;

class Product extends Model
{
    //
    protected $primaryKey = "id";
    protected $table = "sp_products";

    public function Catagories(){
        return $this->belongsTo('App\Catagories','fk_cat_id');
    }

    public function next(){
        $products = [];
        if(session("selectedCat") == "*"){
            $products = Product::where("id",">=",1)->orderBy('id','desc')->get();
        }else{
            $cat_id = session("selectedCat");
            $products = Product::where("cat_id",$cat_id)->orderBy('id','desc')->get();
        }

        

        $justInProducts = [];
        $soldProducts = [];
        for($i = 0;$i<count($products);$i++){
            $title = strtoupper($products[$i]->s_status);
            $needle = "SOLD";
            if(strstr($title,$needle)){
                array_push($soldProducts,$products[$i]);
            }else{
                array_push($justInProducts,$products[$i]);
            }

        }

        //arranging products

        $finalProducts = [];
        for($i = 0;$i<count($justInProducts);$i++){
            array_push($finalProducts,$justInProducts[$i]);
        }

        for($i = 0;$i<count($soldProducts);$i++){
            array_push($finalProducts,$soldProducts[$i]);
        }

        //finding next product
        $nextProduct = null;
        for($i = 0;$i<count($finalProducts);$i++){
            if($finalProducts[$i]->id == $this->id){
                if(isset($finalProducts[$i+1])){
                    $nextProduct = $finalProducts[$i+1];
                    break;
                }else{
                    break;
                }
            }
        }

        return $nextProduct;

    }

    public function Thumbs(){
        return Thumbs::where("org_id",$this->id)->get();
    }

    public function previous(){
        return Product::where("id",">",$this->id)->orderBy('id','desc')->first();
     }
}
