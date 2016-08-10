<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentRegimen extends Model
{
    protected $table='treatment_regimens';
    protected $fillable=[
        'code',
        'patientId',
        'treatmentPackageId',
        'note',
        'status',
        'createdDate',
        'updateDate',
        'createdBy',
        'updatedBy',
        'active'
    ];
    public function TreatmentPackage(){
        return $this->belongsTo('App\TreatmentPackage','treatmentPackageId','id')->first();
    }
}
