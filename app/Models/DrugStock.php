<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugStock extends Model
{
	use SoftDeletes;

	protected $table = 'stocks'; //
    public $timestamps = false;//
    protected $dates = ['invoice_date'];//

    public function getTotalPriceAttribute() 
    {
    return $this->quantity * $this->unit_price;
	}
}
