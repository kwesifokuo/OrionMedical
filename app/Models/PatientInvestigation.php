<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class PatientInvestigation extends Model
{
    protected $table = 'patient_investigation';
    public $timestamps = false;

     protected $dates = ['created_on'];

}
