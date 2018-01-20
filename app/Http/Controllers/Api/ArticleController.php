<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\Articles;
use App\Http\Resources\ArticlesCollection;
use App\Repositories\Api\ArticlesRepository as Repository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Repository $repo)
    {
    	$queries = request()->validate([
    		'keywords' => 'string',
    		'keyword' => 'string',
    		'name' => 'string',
    		'authors' => 'string',
    		'abstract' => 'string',
            'sort' => [
                'string', 
                'regex:(asc|desc)',
            ],
    	]);

    	return new ArticlesCollection($repo->getAll($queries));
    }

    public function show(Article $article)
    {
        return new Articles($article->load('author'));
    }

}
