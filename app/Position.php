<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';
    protected $fillable = [
        'name',
        'description',
        'active',
        'createdBy',
        'upDatedBy'
    ];
    public function User()
    {
        return $this->hasMany('App\User','positionId','id')->get();
    }
}
