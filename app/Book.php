<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Guarded attribute
     * @var array
     */
    protected $guarded = ['id'];

    /*RELATIONSHIP SECTION*/

    public function author(){
        return $this->belongsToMany('App\User');
    }
}
