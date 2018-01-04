<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\Users;
use App\Http\Resources\UsersCollection;
use App\Http\Resources\Users as UsersResource;

class UserController extends Controller
{
    public function index(Users $users)
    {
		$users = $users->getAll();

		return new UsersCollection($users);
    }

    public function show(User $user)
    {
    	return new UsersResource($user);
    }
}
