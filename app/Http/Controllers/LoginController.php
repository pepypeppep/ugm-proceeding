<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	/**
	 * login attempt using API user provider
	 * and store the token into session
	 * 
	 * @param  UsersRepository $repo
	 * @return Authenticatable
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
    		auth()->user()->api_token = $token;
            session(['api_token' => $token]);
    		return Auth::user()->name."<br>".$token;
    	}
    }
}
