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
        'provincialId',
        'createdBy',
        'upDatedBy',
        'active'
    ];
}
