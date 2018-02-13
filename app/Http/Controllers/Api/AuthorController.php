<?php

namespace App\Http\Controllers\Api;

use App\Author;
use App\Http\Controllers\Controller;
use App\Http\Resources\Authors;
use App\Http\Resources\AuthorsCollection;
use App\Repositories\Api\AuthorsRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
	/**
    * @SWG\Get(
    *     path="/authors/",
    *     summary="Get all authors",
    *     description="Return collection of authors",
    *     operationId="getAllProceedings",
    *     tags={"authors"},
    *     produces={"application/json"},
    *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         description="name values that need to be considered for filter",
     *         required=false,
     *         type="string",
     *     ),
    *     @SWG\Response(
    *         response=200,
    *         description="successful operation"
    *     )
    * )
    */
    public function index(AuthorsRepository $repository)
    {
    	$query = request()->validate([
    		'name' => 'string'
    	]);

    	return new AuthorsCollection($repository->getAll($query));
    }

    /**
     * @SWG\Put(
     *      path="/authors/{authorId}",
     *      tags={"authors"},
     *      operationId="updateAuthors",
     *      summary="Update existing author",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         description="ID of proceeding to return",
     *         in="path",
     *         name="authorId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Author object that needs to be updated",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="name", type="string", example="Wildan Ainurrahman"),
     *              @SWG\Property(property="email", type="string", example="wildan@gmail.com"),
     *              @SWG\Property(property="affiliation", type="string", example="BPP UGM")
     *          ),      
     *      ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function update(Author $author)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'affiliation' => 'required|string',
            'email' => 'nullable|email'
        ]);

        $author->update($data);

        return new Authors($author);
    }
}
