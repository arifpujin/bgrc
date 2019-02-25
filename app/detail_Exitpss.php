<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_Exitpss extends Model
{
    //Table detail_exitpass
    protected $table = 'detail_exitpass';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id','name','noem','depart','purpose','tipe','hod_status','apr_name','hod_date','hod_time','name_police_out','date_out','time_out','name_police_in','date_in','time_in',
    ];
    protected $guarded = array('id');
}
