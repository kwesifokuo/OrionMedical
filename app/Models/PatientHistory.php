<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientHistory extends Model
{
	use SoftDeletes;
    protected $table = 'patient_history';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
}






