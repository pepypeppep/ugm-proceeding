<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UsersRepository;

class LoginController extends Controller
{

	public function store(Request $request, UsersRepository $repo)
	{
		$credentials = $request->validate([
			'email' => 'required|email|string',
			'password' => 'required|string',
		]);

		if (Auth::guard('web')->once($credentials)) {

			$token = $repo->getToken();

		    return response([
		    	'error' => false,
		    	'message' => 'Login succeed',
		    	'user' => auth()->user(),
		    	'token' => $token,
		    ])->cookie('user1', auth()->user()->name);
		}

		return response([
			'error' => true,
			'message' => 'login failed',
		]);
	}    
}
