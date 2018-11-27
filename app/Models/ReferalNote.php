<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferalNote extends Model
{
      use SoftDeletes;
      protected $table = 'referal_notes';
      public $timestamps = false;
      protected $dates =['deleted_at'];
}
