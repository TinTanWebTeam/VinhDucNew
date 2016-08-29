<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationTreatment extends Model
{
    protected $table = 'location_treatments';
    protected $fillable = [
        'name',
        'note',
        'active',
        'createdBy',
        'upDatedBy'
    ];
//    public function ProTreatment(){
//        return $this->hasMany('App\ProfessionalTreatment','locationTreatmentId','id')->get();
//
//    }
}
