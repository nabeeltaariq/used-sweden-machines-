<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceDetail;
use App\CustomerProduct;
use App\contact;

class Service extends Model
{
    //
    protected $table = "sp_productservice";
    public $timestamps = false;

    public function Detail(){
        return ServiceDetail::where("productId",$this->id)->first();
    }

    public function Suppliers(){
       $supplierIds = CustomerProduct::where("productId",$this->id)->get();
       $data = array();
       foreach($supplierIds as $supplier){
            $currentContact =  contact::where("contactId",$supplier->customer_spplier_id)->first();
            $info = [
                "rate" => $supplier->rate,
                "mode" => $supplier->buyOrSell,
                "customerInfo" => $currentContact
            ];
            array_push($data,$info);
        }

        return $data;
    }


    public function Previous(){
        $result = Service::where("id",">",0)->orderBy("name","desc")->get();
        $foundedFlag = -1;
        for($i = 0;$i<count($result);$i++){
            if($result[$i]->id == $this->id){
                $foundedFlag = $i;
                    break;
            }
        }

        if(isset($result[--$foundedFlag])){
            return $result[$foundedFlag];
        }else{
            return null;
        }
    }


    public function Next(){
       $result = Service::where("id",">",0)->orderBy("name","asc")->get();
       $foundedFlag = -1;
       for($i = 0;$i<count($result);$i++){
           if($result[$i]->id == $this->id){
               $foundedFlag = $i;
                break;
           }
       }

       if(isset($result[++$foundedFlag])){
           return $result[$foundedFlag];
       }else{
           return null;
       }
    }
}
