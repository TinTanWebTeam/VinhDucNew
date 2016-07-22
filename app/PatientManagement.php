<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientManagement extends Model
{
    protected $table='patient_managements';
    protected $fillable=[
        'code',
        'fullName',
        'birthday',
        'sex',
        'weight',
        'height',
        'bloodPressure',
        'pulse',
        'job',
        'address',
        'provincialId',
        'ageId',
        'createdBy',
        'upDatedBy',
        'active'
    ];
}
