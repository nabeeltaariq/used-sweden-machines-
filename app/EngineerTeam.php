<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineerTeam extends Model
{
    //
    protected $table = "sp_engineer";
    public $timestamps = false;
    protected $primaryKey = "engineerId";
}
