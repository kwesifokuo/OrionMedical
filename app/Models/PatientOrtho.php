<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class PatientOrtho extends Model
{
    protected $table = 'patient_ortho';
    public $timestamps = false;
	protected $dates = ['created_on'];
}
