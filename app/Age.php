<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    protected $table='ages';
    protected $fillable=[
        'age',
        'createdBy',
        'upDatedBy',
        'active'
    ];
    
    public function Therapist(){
        return $this->belongsTo('App\ManagementTherapist','ageId','id')->get();
    }
}
