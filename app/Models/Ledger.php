<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
   protected $table = 'invoice';

   public function payments()
    {
        return $this->hasMany('OrionMedical\Models\Payments', 'EventID', 'visit_id');
    }


    public function getTotalPriceAttribute() {
    return $this->quantity * $this->amount;
}
}
