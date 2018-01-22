<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = ['id'];

    public function article(){
    	return $this->belongsTo('App\Article');
    }

}
