<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = "sp_users";
    protected $primaryKey = "uId";
    public $timestamps = false;
}
