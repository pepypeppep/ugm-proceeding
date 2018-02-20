<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Proceeding extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at', 'conference_start', 'conference_end', 'published_at'];
    protected $guarded = ['id'];

    /**
     * RELATIONS SECTION
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

    public function owner(){
        return $this->belongsToMany('App\User', 'proceeding_user', 'proceeding_id', 'user_id');
    }

    /*
    * CUSTOM ATTRIBUTE SECTION
    */
   
    /**
     * Generate attribute based on published_at value
     * @return string [draft/published]
     */
    public function getStatusAttribute(){
        return empty($this->published_at) ? 'draft' : 'published';
    }

    /**
     * Generate the identifiers
     * @return array 
     */
    public function getIdentifiersAttribute(){
        $identifiers = collect(array());

        if (!empty($this->issn)) {
            $identifiers->push([
                'type' => 'issn',
                'id' => $this->issn,
            ]);
        }

        if (!empty($this->print_isbn)) {
            $identifiers->push([
                'type' => 'print_isbn',
                'id' => $this->print_isbn,
            ]);
        }

        if (!empty($this->online_isbn)) {
            $identifiers->push([
                'type' => 'online_isbn',
                'id' => $this->online_isbn,
            ]);
        }

        return $identifiers;
    }

    /**
     * Generate url for front cover
     * @return string 
     */
    public function getFrontCoverUrlAttribute(){
        if (!empty($this->front_cover)) {
            return Storage::url($this->front_cover);
        }

        return null;
    }

    /**
     * Generate url for back cover
     * @return string 
     */
    public function getBackCoverUrlAttribute(){
        if (!empty($this->back_cover)) {
            return Storage::url($this->back_cover);
        }

        return null;
    }
        
}
