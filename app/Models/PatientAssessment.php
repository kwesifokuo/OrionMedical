<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientAssessment extends Model
{
	use SoftDeletes;

   
    protected $dates = ['deleted_at'];
    protected $table = 'patient_assessment';
    public $timestamps = false;

}
