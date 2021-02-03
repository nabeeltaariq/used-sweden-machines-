<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactTeam extends Model
{
    //
    protected $table = "sp_contact_team";
    public $timestamps = false;
    protected $primaryKey = "teamId";
}
