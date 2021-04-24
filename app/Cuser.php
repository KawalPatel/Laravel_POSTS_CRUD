<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuser extends Model
{
    //table name
    protected $table = 'users';

    //primary key
    public $primaryKey = 'id';

    //timestamps
    public $timestamps = true;

    public function user()
    {
        // return $this->belongsTo('App\Post');
    }
}
