<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    protected $table = "sp_testimonials";
    public $tablestmaps = false;
    protected $primaryKey = "testimonialId";
}
