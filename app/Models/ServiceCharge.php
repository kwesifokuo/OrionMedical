<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCharge extends Model
{
    protected $table = 'service_prices';
     public $timestamps = false;
      protected $dates = ['deleted_at']; 
}


