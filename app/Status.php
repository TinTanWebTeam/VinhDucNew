<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table='statuses';
    protected $fillable=[
        'therapistCode',
        'ail',
        'detailTreatmentId',
        'createdDate',
        'dateStart',
        'dateEnd',
        'active'
    ];
}
