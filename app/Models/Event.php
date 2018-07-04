<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'appointments';
    public $timestamps = false;
    protected $dates = ['start_time','created_on'];
}
