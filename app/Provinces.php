<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinces';
    protected $fillable = [
        'name',
        'createdBy',
        'upDatedBy',
        'active'
    ];
    public function Therapist(){
        return $this->belongsTo('App\ManagementTherapist','ageId','id')->get();
    }
    public function Doctor(){
        return $this->belongsTo('App\Doctor','ageId','id')->get();
    }
}
