<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\Api\UsersRepository as Repository;
use App\Http\Resources\UsersCollection;
use App\Http\Resources\Users as UsersResource;

class UserController extends Controller
{
    /**
    * @SWG\Get(
    *     path="/users/",
    *     summary="Get all AAA",
    *     description="Return collection of users",
    *     operationId="getAllUsers",
    *     tags={"user"},
    *     produces={"application/json"},
    *     @SWG\Response(
    *         response=200,
    *         description="successful operation"
    *     )
    * )
    */
    public function index(Repository $repository)
    {
    	$queries = request()->validate([
    		'name' => 'string',
    		'email' => 'string',
    		'sort' => [
                'string', 
                'regex:(asc|desc)',
            ],
    	]);

		$repository = $repository->getAll($queries);

		return new UsersCollection($repository);
    }

    /**
     * @SWG\Get(
     *     path="/users/{usersId}",
     *     summary="Find user by Id",
     *     description="Returns a single user",
     *     operationId="getUserById",
     *     tags={"user"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="ID of user to return",
     *         in="path",
     *         name="usersId",
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
    public function show(User $user)
    {
    	return new UsersResource($user);
    }
}
