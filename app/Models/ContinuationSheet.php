<?php

namespace OrionMedical\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContinuationSheet extends Model
{
	  use SoftDeletes;
      protected $table = 'continuation_sheets';
      public $timestamps = false;
      protected $dates =['deleted_at'];

}
