<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table='packages';
    protected $fillable = [
        'name',
        'note',
        'price',
        'treatmentPackageId',
        'createdBy',
        'upDatedBy',
        'active'
    ];
    
//    public function TreatmentPackage()
//    {
//        return $this->hasMany('App\TreatmentPackage','packageId','id')->get();
//    }
}
