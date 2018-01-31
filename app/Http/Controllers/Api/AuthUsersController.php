<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\Users as Resource;

class AuthUsersController extends Controller
{
	/**
	 * Search user with request paramenter
	 * @return Resource User resource
	 */
    public function show()
    {
    	if (request()->has('email')) {
    		$user = User::where('email', request('email'))->first();
    	}

        if (request()->has('remember_token') && request()->has('id')) {
            $user = User::where('id', request('id'))->where('remember_token', request('remember_token'))->first();
        }

    	if (request()->has('id') && !request()->has('remember_token')) {
    		$user = User::find(request('id'));
    	}

    	return new Resource($user);
    }
}
