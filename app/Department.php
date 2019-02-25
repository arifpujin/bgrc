<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'departement';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','id',
    ];
}
