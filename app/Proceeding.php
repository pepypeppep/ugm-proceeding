<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proceeding extends Model
{
	use SoftDeletes;

    /*
    * RELATION SECTION
    */
    public function article(){
    	return $this->hasMany('App\Article');
    }

    public function author(){
    	return $this->hasManyThrough('App\Author', 'App\Article');
    }

    public function subject(){
    	return $this->belongsToMany('App\Subject');
    }

    public function editor(){
        return $this->hasMany('App\Editor');
    }

    /*
    * CUSTOM ATTRIBUTE SECTION
    */

    // set status attribute based on published at value
    public function getStatusAttribute(){
        return empty($this->published_at) ? 'draft' : 'published';
    }
        

    protected $dates = ['deleted_at', 'conference_start', 'conference_end'];
}
