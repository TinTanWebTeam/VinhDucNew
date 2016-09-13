<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentPackage extends Model
{
    protected $table='treatment_packages';
    protected $fillable = [
        'code',
        'name',
        'note',
        'packageId',
        'patientId',
        'codeDoctor',
        'umpteenth',
        'createdDate',
        'createdBy',
        'updateDate',
        'upDatedBy',
        'active'
    ];
//    public function Package(){
//        return $this->belongsTo('App\Package','packageId','id')->first();
//    }
    public function Patient(){
        return $this->belongsTo('App\PatientManagement','patientId','code')->first();
    }
}
