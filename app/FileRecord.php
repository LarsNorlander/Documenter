<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileRecord extends Model {
    //Model for tbl_file_records
    use SoftDeletes;

    protected $table = 'tbl_file_records';

    protected $fillable = [
        'mime',
        'filename',
        'total_versions',
        'public_version',
        'owner_id'
    ];

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function achievements(){
        return $this->hasOne('App\Achievements', 'achievement_id')->withTrashed();
    }
}
