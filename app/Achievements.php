<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    protected $table = 'tbl_achievements';

    public function file(){
        return $this->belongsTo('App\FileRecord', 'achievementID');
    }

}

