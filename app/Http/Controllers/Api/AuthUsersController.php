<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\Users as Resource;

class AuthUsersController extends Controller
{
    public function index()
    {
    	return Resource::collection(User::all());
    }
}
