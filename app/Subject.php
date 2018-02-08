<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = ['id'];

    public function proceeding(){
    	return $this->belongsToMany('App\Proceeding');
    }
}
