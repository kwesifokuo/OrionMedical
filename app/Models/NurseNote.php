<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NurseNote extends Model
{
      use SoftDeletes;
      protected $table = 'nurse_notes';
      public $timestamps = false;
      protected $dates =['deleted_at'];
}
