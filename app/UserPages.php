<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPages extends Model
{
    //
    protected $table = "sp_userpages";
    protected $primaryKey = "pId";
    public $timestamps = false;
}
