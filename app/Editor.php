<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    public function proceeding(){
    	return $this->belongsTo('App\Proceeding');
    }
}
