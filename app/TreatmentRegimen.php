<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentRegimen extends Model
{
    protected $table = 'treatment_regimens';
    protected $fillable = [
        'code',
        'patientId',
        'createdBy',
        'status',
        'therapist',
        'createdDate',
        'updatedDate',
        'note',
        'updatedBy',
        'active'
    ];
}
