<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    protected $table='diagnoses';
    protected $fillable=[
        'name',
        'patientManagementId',
        'createdBy',
        'upDatedBy',
        'active'
    ];
}
