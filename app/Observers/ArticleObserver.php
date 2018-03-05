<?php

namespace App\Observers;

use App\Article;
use App\Identifier;

/**
* Article Observer
*/
class ArticleObserver
{
    public function created(Article $article)
    {
        $identifier = new Identifier;

        $article->identifiers()->attach($identifier->getIdentifierId('Article'));
    }    
}
