<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievements extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_achievements';

    public function file(){
        return $this->belongsTo('App\FileRecord', 'achievementID');
    }

    protected $dates = ['deleted_at'];

}

