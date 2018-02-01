<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indexation extends Model
{
    protected $guarded = ['id'];

    /*
    RELATIONSHIP SECTION
     */
    
    public function article(){
    	return $this->belongsTo('App\Article');
    }
}
