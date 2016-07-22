<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table='doctors';
    protected $fillable=[
        'code',
        'name',
        'reference',
        'note',
        'provincialId',
        'createdBy',
        'upDatedBy',
        'active'
    ];
}
