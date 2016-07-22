<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalTreatment extends Model
{
    protected $table='professional_treatments';
    protected $fillable=[
        'name',
        'note',
        'createdBy',
        'upDatedBy',
        'active'
    ];
}
