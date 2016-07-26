<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table='statuses';
    protected $fillable=[
        'name',
        'therapistId',
        'doctorId',
        'patientId',
        'createdBy',
        'upDatedBy',
        'active'
    ];
}
