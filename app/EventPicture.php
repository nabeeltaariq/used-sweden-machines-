<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPicture extends Model
{
    //
    protected $table = "sp_eventpictures";
    public $timestamps = false;
    protected $primaryKey = "pictureId";
}
