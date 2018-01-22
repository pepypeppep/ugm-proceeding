<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    /*
    RELATIONSHIP SECTION
     */
    public function proceeding(){
    	return $this->belongsTo('App\Proceeding');
    }

    public function article_identifier(){
    	return $this->hasMany('App\ArticleIdentifier');
    }

    public function author(){
    	return $this->hasMany('App\Author');
    }

    public function indexation(){
        return $this->hasOne('App\Indexation');
    }

    /*
    CUSTOM METHOD SECTION
     */
    public function setKeywords()
    {
        return explode(',', $this->keywords);
    }
    
    /**
     * get article's identifiers. Merged from proceeding's and article's identifier
     * @return string ISSN, ISBN, DOI
     */
    public function getIdentifiers(){
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
     /**
      * Generate file link and type
      * @return array PDF|DOAJ|SCOPUS
      */
    public function getFile()
    {
        if ($this->indexed) {
            return [
                'type' => $this->indexation->type,
                'link' => $this->indexation->link,
            ];
        }

        return [
            'type' => 'PDF',
            'link' => $this->file,
        ];
    }

    /*
    CUSTOM ATTRIBUTE SECTION
     */
    
    /**
     * get indexed attribute based on indexation existance
     * @return bool
     */
    public function getIndexedAttribute(){
        return $this->indexation()->count() == 1;
    }
        
        
}
