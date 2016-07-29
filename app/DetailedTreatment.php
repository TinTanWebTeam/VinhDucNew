<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailedTreatment extends Model
{
    protected $table = 'detailed_treatments';
    protected $fillable = [
        'name',
        'treatmentPackageId',
        'professionalTreatmentId',
        'therapistId',
        'ail',
        'note',
        'active',
        'createdDate',
        'updateDate',
        'createdBy',
        'upDatedBy'
    ];
}