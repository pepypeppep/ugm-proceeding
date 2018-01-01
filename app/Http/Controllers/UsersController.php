<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Users;

class UsersController extends Controller
{
    public function index(Request $request, Users $users)
    {
    	$query = $request->validate([
    		'sort'
    	]);
    	return $users->getAll();
    }
}
