<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proceeding extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at', 'conference_start', 'conference_end'];

    protected $guarded = ['id'];

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

    /*
    * CUSTOM ATTRIBUTE SECTION
    */

    // set status attribute based on published at value
    public function getStatusAttribute(){
        return empty($this->published_at) ? 'draft' : 'published';
    }

    public function getIdentifiersAttribute(){
        $identifiers = collect(array());

        if (!empty($this->issn)) {
            $identifiers->push([
                'type' => 'issn',
                'id' => $this->issn,
            ]);
        }

        if (!empty($this->isbn)) {
            $identifiers->push([
                'type' => 'isbn',
                'id' => $this->isbn,
            ]);
        }

        return $identifiers;
    }
}
