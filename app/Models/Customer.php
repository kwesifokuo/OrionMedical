<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Customer extends Model
{

     use SoftDeletes;


      protected $table = 'patient';

    protected $fillable = [
            'patient_id',
            'fullname',
            'date_of_birth',
            'gender,',
            'civil_status',
            'place_of_birth',
            'blood_group',
            'postal_address',
            'residential_address',
            'email',
            'mobile_number',
            'occupation',
            'image',

              ];
           
            
            protected $dates = ['date_of_birth','created_on','expiry_date','deleted_at'];
            protected $hidden = ['remember_token'];
            public $timestamps = false;


            

  
}
