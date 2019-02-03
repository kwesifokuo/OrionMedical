<?php

namespace OrionMedical\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContinuationSheetOP extends Model
{
	  use SoftDeletes;
      protected $table = 'continuation_sheets_op';
      public $timestamps = false;
      protected $dates =['deleted_at'];

}