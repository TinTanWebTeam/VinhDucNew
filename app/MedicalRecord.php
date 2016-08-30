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
        'subclinical',
        'active'
    ];
    public function PatientManagement()
    {
        return $this->belongsTo('App\PatientManagement','patientId','code')->first();
    }
}
