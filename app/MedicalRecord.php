<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $table='medical_records';
    protected $fillable = [
        'patientId',
        'PathologicalProcess',
        'anamnesis',
        'body',
        'parts',
        'pulse',
        'temperature',
        'bloodPressure',
        'breathing',
        'weight',
        'height',
        'subclinical',
        'active'
    ];
    public function PatientManagement()
    {
        return $this->belongsTo('App\PatientManagement','patientId','id')->first();
    }
}
