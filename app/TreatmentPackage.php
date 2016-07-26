<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentPackage extends Model
{
    protected $table='treatment_packages';
    protected $fillable = [
        'name',
        'note',
        'packageId',
        'patientId',
        'createdDate',
        'createdBy',
        'updateDate',
        'upDatedBy',
        'active'
    ];
    public function Package(){
        return $this->belongsTo('App\Package','packageId','id')->first();
    }
}
