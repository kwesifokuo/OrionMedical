<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class Labs extends Model
{
   protected $table = 'patient_test_results';
   public $timestamps = false;
}
