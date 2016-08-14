<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagementTherapist extends Model
{
    protected $table='management_therapists';
    protected $fillable=[
        'code',
        'name',
        'address',
        'phone',
        'sex',
        'ageId',
        'provincialId',
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
    public function InformationTherapist(){
        return $this->hasMany('App\InformationSurveys','therapist_Id','id')->get();
    }
}
