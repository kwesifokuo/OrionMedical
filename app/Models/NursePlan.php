<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NursePlan extends Model
{
   use SoftDeletes;
      protected $table = 'nurse_plans';
      public $timestamps = false;
      protected $dates =['deleted_at'];
}
