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

    /**
     * @SWG\Get(
     *     path="/articles/{articleId}",
     *     summary="Find article by Id",
     *     description="Returns a single article with authors",
     *     operationId="getArticleById",
     *     tags={"articles"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of proceeding to return",
     *         in="path",
     *         name="articleId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Proceeding not found"
     *     )
     * )
     */
    public function show(Article $article)
    {
        return new Articles($article->load('author'));
    }

    /**
     * @SWG\Post(
     *      path="/articles",
     *      tags={"articles"},
     *      operationId="createNewArticle",
     *      summary="Create a new article",
     *      description="",
     *      consumes={"multipart/form-data"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         description="Article's proceeding id",
     *         format="int64",
     *         in="formData",
     *         name="proceeding_id",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's title",
     *         format="string",
     *         in="formData",
     *         name="title",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's abstract",
     *         format="string",
     *         in="formData",
     *         name="abstract",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's start page",
     *         format="int64",
     *         in="formData",
     *         name="start_page",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's end page",
     *         format="int64",
     *         in="formData",
     *         name="end_page",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's keyword. Seperate with comma. Ex: Computer technology, Information, system",
     *         format="string",
     *         in="formData",
     *         name="keywords",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="First author's name",
     *         format="string",
     *         in="formData",
     *         name="authors[0][name]",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="First author's email",
     *         format="string",
     *         in="formData",
     *         name="authors[0][email]",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="First author's affiliation",
     *         format="string",
     *         in="formData",
     *         name="authors[0][affiliation]",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="file_type",
     *         in="formData",
     *         description="File type values of the article",
     *         required=true,
     *         type="string",
     *         enum={"pdf", "scopus", "doaj"},
     *         default="pdf"
     *     ),
     *     @SWG\Parameter(
     *         name="file_link",
     *         in="formData",
     *         description="File link value. Required if file type not pdf",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         description="Upload pdf file",
     *         in="formData",
     *         name="file_pdf",
     *         required=false,
     *         type="file"
     *     ),
     *     @SWG\Parameter(
     *         name="doi",
     *         in="formData",
     *         description="DOI of the article",
     *         required=true,
     *         type="string",
     *     ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function store(StoreArticles $request, Repository $repository)
    {
        return new Articles($repository->create($request));
    }

    /**
     * @SWG\Put(
     *      path="/articles/{articleId}",
     *      tags={"articles"},
     *      operationId="updateArticle",
     *      summary="Update exsisting article",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         description="Article's id",
     *         in="path",
     *         name="articleId",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's title",
     *         format="string",
     *         in="query",
     *         name="title",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's abstract",
     *         format="string",
     *         in="query",
     *         name="abstract",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's start page",
     *         in="query",
     *         name="start_page",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's end page",
     *         in="query",
     *         name="end_page",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Article's keyword. Seperate with comma. Ex: Computer technology, Information, system",
     *         format="string",
     *         in="query",
     *         name="keywords",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="doi",
     *         in="query",
     *         description="DOI of the article",
     *         required=true,
     *         type="string",
     *     ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function update(Article $article, Repository $repository)
    {
        $request = request()->validate([
            'abstract' => 'required|string',
            'doi' => 'required|string',
            'end_page' => 'required|integer',
            'keywords' => 'required|string',
            'start_page' => 'required|integer',
            'title' => 'required|string',
        ]);

        return new Articles($repository->update($article, $request));
    }

}
