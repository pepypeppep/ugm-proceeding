<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

	public function store(Request $request)
	{
		$credentials = $request->validate([
			'email' => 'required|email|string',
			'password' => 'required|string',
		]);

		if (Auth::guard('web')->once($credentials)) {
		    return response([
		    	'error' => false,
		    	'message' => 'Login succeed',
		    	'user' => auth()->user(),
		    ]);
		}

		return response([
			'error' => true,
			'message' => 'login failed',
		]);
	}
    
}
