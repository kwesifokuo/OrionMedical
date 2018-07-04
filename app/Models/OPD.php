<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OPD extends Model
{
    use SoftDeletes;
    protected $table = 'admissions';


 protected $fillable = [
  'opd_number' ,
  'patient_id',
  'name',
  'referal_doctor',
  'consultation_type' , 
  ];

    public $timestamps = false;
    protected $dates =['created_on','checkout_time','deleted_at'];


    public function patient()
    {
        return $this->belongsTo('OrionMedical\Models\Customer', 'patient_id', 'patient_id');
    }

    public function bills()
    {
        return $this->hasMany('OrionMedical\Models\Bill', 'visit_id', 'opd_number');
    }

    public function payments()
    {
        return $this->hasMany('OrionMedical\Models\Payments', 'EventID', 'opd_number');
    }

    public function diagonsis()
    {
        return $this->hasMany('OrionMedical\Models\PatientDiagnosis', 'visitid', 'opd_number');
    }
  

}
