<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table='packages';
    protected $fillable = [
        'name',
        'note',
        'treatmentPackageId',
        'createdBy',
        'upDatedBy',
        'active'
    ];

//    public function TreatmentPackage()
//    {
//        return $this->hasMany('App\TreatmentPackage','TreatmentpackageId','id')->get();
//    }
}
