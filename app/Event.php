<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = "sp_events";
    public $timestamps = false;
    protected $primaryKey = "eventId";
}
