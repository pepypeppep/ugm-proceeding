<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlesRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $repository;

    function __construct()
    {
    	$this->repository = new ArticlesRepository;
    }

    public function create($proceeding)
    {
    	$proceeding = $this->repository->find($proceeding);
    	
        return view('dashboard.article.create', compact('proceeding'));
    } 

    public function store()
    {
        $articles = $this->repository->store();

        return $articles;
    }

}
