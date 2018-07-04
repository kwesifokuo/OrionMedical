<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescriptions';

    public $timestamps = false;

    protected $dates = ['date_dispensed','created_on'];
}
