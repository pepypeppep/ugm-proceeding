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

    public function show(User $user)
    {
    	return new UsersResource($user);
    }
}
