<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformationSurveys extends Model
{
    protected $table = 'information_surveys';
    protected $fillable = [
        'createdDate',
        'patientReviews',
        'question',
        'handling',
        'patient_id',
        'therapist_id',
    ];
    public function InformationPatientId()
    {
        return $this->belongsTo('App\PatientManagement','patient_id','id')->first();
    }
    public function InformationTherapistId()
    {
        return $this->belongsTo('App\ManagementTherapist','therapist_id','id')->first();
    }
}
