<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table='doctors';
    protected $fillable=[
        'code',
        'name',
        'address',
        'phone',
        'sex',
        'note',
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
}
