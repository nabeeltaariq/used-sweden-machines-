<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPages extends Model
{
    //
    protected $table = "sp_adminpages";
    protected $primaryKey = "pageId";
    public $timestamps = false;
}
