<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class Consumables extends Model
{
     protected $table = 'consumables2';
      public $timestamps = false;
      protected $dates =['expiry_date'];
}
