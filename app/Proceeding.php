<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proceeding extends Model
{
	use SoftDeletes;
    
    public function article(){
    	return $this->hasMany('App\Article');
    }

    public function author(){
    	return $this->hasManyThrough('App\Author', 'App\Article');
    }

    public function proceeding_subject(){
    	return $this->hasMany('App\ProceedingSubject');
    }

    public function subject(){
    	return $this->belongsToMany('App\Subject');
    }

    protected $dates = ['deleted_at'];
}
