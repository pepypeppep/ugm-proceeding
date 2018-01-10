<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Proceedings;
use App\Proceeding;

class ProceedingController extends Controller
{
    public function index()
    {
    	return new Proceedings(Proceeding::first());
    }
}
