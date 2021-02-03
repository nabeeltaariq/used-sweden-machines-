<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\contact;

class ContactHead extends Model
{
    //
    protected $table = "contactheads";
    protected $primaryKey = "id";

    public function CountContacts(){
        return contact::where("contactTypeId",$this->id)->count();
    }
}
