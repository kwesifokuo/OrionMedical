<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
     protected $table = 'payments';
     public $timestamps = false;



     public function getTotalPriceAttribute() {
    return $this->AmountReceived;
}


    public function invoices()
    {
        return $this->belongsTo('OrionMedical\Models\Ledger', 'EventID', 'visit_id');
    }

     public function items()
    {
        return $this->hasMany('OrionMedical\Models\Bill', 'visit_id','EventID');
    }


     public function getTotalReceivedAttribute() {
    return $this->sum('AmountReceived');
}


}
