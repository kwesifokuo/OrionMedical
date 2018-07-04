<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class LabTestResult extends Model
{
   protected $table = 'patient_test_result_master';
   public $timestamps = false;

   protected $fillable =['result','test','labid','range','impression','interpretation','created_on','created_by','template'];
}
