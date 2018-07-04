<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
	//use SoftDeletes;
    protected $table = 'bills';

    public $timestamps = false;



public function getTotalPriceAttribute() {
    return $this->quantity * $this->amount;
}

public function payments()
    {
        return $this->hasMany('OrionMedical\Models\Payments', 'EventID', 'visit_id');
    }
   
}


