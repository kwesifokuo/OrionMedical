<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{
	protected $table = 'drugs';
    public $timestamps = false;

     protected $dates = ['expiry_date','deleted_at']; 

}


