<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    protected $guarded = ['id'];

    /*RELATIOSHIP SECTION*/
    public function proceedings(){
        return $this->morphedByMany('App\Proceeding', 'identifiable');
    }

    public function articles(){
        return $this->morphedByMany('App\Article', 'identifiable');
    }

    public function books(){
        return $this->morphedByMany('App\Book', 'identifiable');
    }

    /*CUSTOM METHOD*/
    /**
     * Get identifier related model ID
     * @param  string $model Eloquent model name
     * @return array array of id
     */
    public function getIdentifierId($model = null)
    {
        $method = 'get'.$model.'IdentifierName';

        return $this->whereIn('type', $this->{$method}())->get()->pluck('id');
    }

    public function getProceedingIdentifierName(){
        return [
            'online_issn',
            'print_issn',
            'online_isbn',
            'print_isbn',
        ];
    }

    public function getArticleIdentifierName(){
        return [
            'doi',
        ];
    }

    public function getBookIdentifierName(){
        return [
            'online_issn',
            'print_issn',
            'online_isbn',
            'print_isbn',
        ];
    }
        
}
