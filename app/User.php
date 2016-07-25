<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','fullName', 'password','active','createdBy','upDatedBy'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function Role(){
        return $this->belongsTo('App\Role','roleId','id')->first();
    }
    public function Position(){
        return $this->belongsTo('App\Position','positionId','id')->first();
    }
}
