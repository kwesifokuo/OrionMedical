<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class AntenatalChart extends Model
{
    protected $table = 'antenatal_chart';
    protected $dates = ['lmp','edd'];
    public $timestamps = false;
}
