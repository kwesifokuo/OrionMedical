<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceCompany extends Model
{
     protected $table = 'insurance_companies';
      public $timestamps = false;
      protected $dates = ['deleted_at']; 
}


