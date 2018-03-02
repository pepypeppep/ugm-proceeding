<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    protected $guarded = ['id'];

    /*RELATIOSHIP SECTION*/
    public function proceedings(){
        return $this->morphedByMany('App\Proceeding', 'identifiable');
    }

    public function articles(){
        return $this->morphedByMany('App\Article', 'identifiable');
    }

    public function books(){
        return $this->morphedByMany('App\Book', 'identifiable');
    }
}
