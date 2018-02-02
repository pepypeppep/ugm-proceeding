<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // protected $repository;

    // function __construct(ArticlesRepository $repository){
    // 	$this->repository = $repository;
    // }

    public function create()
    {
    	return view('dashboard.proceeding.createarticle');
    }
}
