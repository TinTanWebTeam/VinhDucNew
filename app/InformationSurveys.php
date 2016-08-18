<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformationSurveys extends Model
{
    protected $table = 'information_surveys';
    protected $fillable = [
        'createdDate',
        'patientReviews',
        'content',
        'handling',
        'patient_id',
    ];
    public function InformationPatientId()
    {
        return $this->belongsTo('App\PatientManagement','patient_id','id')->first();
    }
    
}
