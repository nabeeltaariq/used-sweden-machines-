<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table = "sp_news";
    public $timestamps = false;

    public function Next(){
        return News::where("id","<",$this->id)->orderBy("id","desc")->first();
    }
}
