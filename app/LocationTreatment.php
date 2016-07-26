<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class locationTreatment extends Model
{
    protected $table = 'location_treatments';
    protected $fillable = [
        'name',
        'note',
        'active',
        'createdBy',
        'upDatedBy'
    ];
}
