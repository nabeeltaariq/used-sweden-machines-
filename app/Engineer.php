<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    //
    public $timestamps = false;
    protected $table = "engineer_team";
    protected $primaryKey = "teamId";
}
