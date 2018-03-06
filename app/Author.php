<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = ['id'];

    /*RELATIONS SECTION*/
    public function article(){
    	return $this->belongsTo('App\Article');
    }

    /*CUSTOM METHODS SECTION*/
    /**
     * Breaks name by 2 groups
     * @return Collection
     */
    public function splitName()
    {
    	return collect(explode(" ", $this->name))->split(2)->values();
    }

    /*CUSTOM ATTRIBUTE SECTION*/

    /**
     * define first_name attribute
     * @return string 
     */
    public function getFirstNameAttribute(){
    	return $this->splitName()->first()->implode(' ');
    }

    /**
     * define last_name attribute
     * @return string 
     */
    public function getLastNameAttribute(){
    	return $this->splitName()->last()->first();
    }
    	
    	

}
