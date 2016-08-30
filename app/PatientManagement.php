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
        'pulse',
        'temperature',
        'bloodPressure',
        'breathing',
        'weight',
        'height',
        'address',
        'HoursMinuteTo',
        'DateMonthYearTo',
        'TimeGoIn',
        'provincialId',
        'sourceCustomerId',
        'age',
        'createdBy',
        'upDatedBy',
        'active'
    ];
    public function TreatmentPackage(){
        return $this->hasMany('App\TreatmentPackage','patientId','code')->get();
    }
    public function MedicalRecord(){
        return $this->hasMany('App\MedicalRecord','patientId','code')->get();
    }
}
