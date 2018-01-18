<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\Users as Resource;

class AuthUsersController extends Controller
{
    public function show()
    {
    	if (request()->has('email')) {
    		$user = User::where('email', request('email'))->first();
    	}

    	if (request()->has('id')) {
    		$user = User::find(request('id'));
    	}

    	return new Resource($user);
    }
}
