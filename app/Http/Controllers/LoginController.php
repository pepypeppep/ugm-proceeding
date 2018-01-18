<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	/**
	 * login attempt using custom user provider
	 * and store the token into auth instance
	 * 
	 * @param  UsersRepository $repo
	 * @return string api_token
	 */
    public function store(UsersRepository $repo)
    {
    	// Manually specify the credentials
    	$credentials = [
    		'email' => 'ugm.proceeding@mail.com',
    		'password' => 'w1lldone',
    	];

    	// merge credential to request instance
    	request()->merge($credentials);

    	// attempt login
    	if (Auth::attempt($credentials)) {
    		$token = $repo->getToken();
    		auth()->user()->setApiToken($token);
    		return auth()->user()->api_token;
    	}
    }
}
