<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CustomerProduct;

class contact extends Model
{
    private $contactTypeId = null;
    //
    protected $table = "sp_contact";
    protected $primaryKey = "contactId";

    public function __construct()
    {
        parent::__construct();
       $this->contactTypeId = session("currentContactTypeId");
    }

    public function next(){


        $count = contact::where("contactUdId",">",$this->contactUdId)->where("contactTypeId",$this->contactTypeId)->count();
        if($count >= 1){
            return contact::where("contactUdId",">",$this->contactUdId)->where("contactTypeId",$this->contactTypeId)->first();
        }else{
            return null;
        }
    }

    public function BuyProducts(){
       return CustomerProduct::where("customer_spplier_id",$this->contactId)->where("buyOrSell",1)->get();
    }


    public function SellProducts(){
        return CustomerProduct::where("customer_spplier_id",$this->contactId)->where("buyOrSell",2)->get();
    }


    public function previous(){


        $count = contact::where("contactUdId","<",$this->contactUdId)->where("contactTypeId",$this->contactTypeId)->count();
        if($count >= 1){
           return contact::where("contactUdId","<",$this->contactUdId)->where("contactTypeId",$this->contactTypeId)->orderBy("contactUdId","desc")->first();
        }else{
            return null;
        }
    }
}
