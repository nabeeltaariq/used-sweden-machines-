<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    //
    protected $table = "sp_references";
    public $timestamps = false;
    protected $primaryKey = "referenceId";
}
