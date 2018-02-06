<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
