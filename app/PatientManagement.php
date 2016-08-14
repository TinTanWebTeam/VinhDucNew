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

    public function Age(){
        return $this->belongsTo('App\Age','ageId','id')->first();
    }
    public function Provinces(){
        return $this->belongsTo('App\Provinces','provincialId','id')->first();
    }
    public function TreatmentPackage(){
        return $this->hasMany('App\TreatmentPackage','patientId','id')->get();
    }
    public function InformationPatient(){
        return $this->hasMany('App\InformationSurveys','patient_Id','id')->get();
    }
    
}
