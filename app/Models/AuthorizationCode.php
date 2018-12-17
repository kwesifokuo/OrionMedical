<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorizationCode extends Model
{
   protected $table = 'loyalty_cards';
   public $timestamps = false;
}
