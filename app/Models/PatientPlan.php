<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientPlan extends Model
{
	use SoftDeletes;
    protected $table = 'patient_plan';
    public $timestamps = false;
     protected $dates = ['deleted_at'];
}











