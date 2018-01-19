<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Articles;
use App\Article;
use App\Repositories\Api\ArticlesRepository as Repository;

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
    	]);

    	return Articles::collection($repo->getAll($queries)->load('author'));
    }
    
}
