<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailedTreatment extends Model
{
    protected $table = 'detailed_treatments';
    protected $fillable = [
        'name',
        'treatmentPackageId',
        'professionalTreatment',
        'location',
        'sesame',
        'minute',
        'time',
        'patientId',
        'serial',
        'note',
        'active',
        'createdDate',
        'updateDate',
        'createdBy',
        'upDatedBy'
    ];
}
