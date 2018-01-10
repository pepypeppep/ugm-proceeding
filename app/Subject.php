<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function proceeding(){
    	return $this->belongsToMany('App\Proceeding');
    }

    
}
