<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientComplaint extends Model
{
	use SoftDeletes;

    protected $table = 'patient_complaint';
    public $timestamps = false;
     protected $dates = ['deleted_at'];
}
