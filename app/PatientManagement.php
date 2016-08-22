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
        'job',
        'address',
        'HoursMinuteTo',
        'DateMonthYearTo',
        'Where',
        'TimeGoIn',
        'provincialId',
        'age',
        'createdBy',
        'upDatedBy',
        'active'
    ];
    
    public function Provinces(){
        return $this->belongsTo('App\Provinces','provincialId','id')->first();
    }
    public function TreatmentPackage(){
        return $this->hasMany('App\TreatmentPackage','patientId','id')->get();
    }
    public function InformationPatient(){
        return $this->hasMany('App\InformationSurveys','patient_Id','id')->get();
    }
    public function MedicalRecord(){
        return $this->hasMany('App\MedicalRecord','patientId','id')->get();
    }
}
