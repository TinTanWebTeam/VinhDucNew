<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalTreatment extends Model
{
    protected $table='professional_treatments';
    protected $fillable=[
        'name',
        'note',
        'locationTreatmentId',
        'createdBy',
        'upDatedBy',
        'active'
    ];
//    public function localTreatment(){
//        return $this->belongsTo('App\LocationTreatment','locationTreatmentId','id')->first();
//    }
}
