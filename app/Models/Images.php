<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
	public $timestamps = false;
	 protected $table = 'uploads';
     protected $dates = ['created_on'];
   	 protected $fillable = [
        'accountnumber',
        'filename',
        'image',
        'filepath',
        'source',
        'mime',
        'created_by'
    ];
}
