<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticles;
use App\Http\Resources\Articles;
use App\Http\Resources\ArticlesCollection;
use App\Repositories\Api\ArticlesRepository as Repository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    /**
    * @SWG\Get(
    *     path="/articles/",
    *     summary="Get all articles with query",
    *     description="Return collection of articles",
    *     operationId="getAllarticles",
    *     tags={"articles"},
    *     produces={"application/json"},
    *     @SWG\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="keyword values that need to be considered for filter",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="author",
     *         in="query",
     *         description="Author name that need to be considered for filter",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="title",
     *         in="query",
     *         description="Article's title that need to be considered for filter",
     *         required=false,
     *         type="string",
     *     ),
    *     @SWG\Response(
    *         response=200,
    *         description="successful operation"
    *     )
    * )
    */
    public function index(Repository $repository)
    {
    	$queries = request()->validate([
    		'keyword' => 'string',
    		'name' => 'string',
    		'author' => 'string',
    		'abstract' => 'string',
            'sort' => [
                'string', 
                'regex:(asc|desc)',
            ],
    	]);

    	return new ArticlesCollection($repository->getAll($queries));
    }

    public function show(Article $article)
    {
        return new Articles($article->load('author'));
    }

    public function store(StoreArticles $request, Repository $repository)
    {
        return new ArticlesCollection($repository->create($request));
    }

}
