<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'description',
        'active',
        'createdBy',
        'upDatedBy'
    ];
    public function User()
    {
        return $this->hasMany('App\User','roleId','id')->get();
    }
}
