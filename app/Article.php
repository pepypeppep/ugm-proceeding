<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use SoftDeletes;

    public function proceeding(){
    	return $this->belongsTo('App\Proceeding');
    }

    public function article_identifier(){
    	return $this->hasMany('App\ArticleIdentifier');
    }

    public function author(){
    	return $this->hasMany('App\Author');
    }

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
}
