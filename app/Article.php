<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public function proceeding(){
    	return $this->belongsTo('App\Proceeding');
    }

    public function article_identifier(){
    	return $this->hasMany('App\ArticleIdentifier');
    }

    public function author(){
    	return $this->hasMany('App\Author');
    }

    public function setKeywords()
    {
        return explode(',', $this->keywords);
    }

    /*
    Custom attribute section
     */
    
    /**
     * get article's identifiers. Merged from proceeding's and article's identifier
     * @return string ISSN, ISBN, DOI
     */
    public function getIdentifiersAttribute(){
        $articleIdentifiers = $this->article_identifier()->get(['type', 'code'])->mapWithKeys(function ($item)
        {
           return [[
            'type' => $item['type'],
            'id' => $item['code'],
           ],];
        });
        
        $identifiers = collect([$this->proceeding->identifiers, $articleIdentifiers])->collapse();

        return $identifiers;
    }
        
}
