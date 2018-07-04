<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsumableRequisition extends Model
{
	 use SoftDeletes;

      protected $table = 'requisitions';
      public $timestamps = false;
      protected $dates =['deleted_at'];
}
