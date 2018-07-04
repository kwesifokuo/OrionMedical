<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientPE extends Model
{
	use SoftDeletes;
    protected $table = 'patient_pe';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
}







