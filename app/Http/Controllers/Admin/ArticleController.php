<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlesRepository;
use App\Repositories\ProceedingsRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $repository;

    function __construct(ArticlesRepository $repository, ProceedingsRepository $proceeding)
    {
    	$this->repository = $repository;
        $this->proceeding = $proceeding;
    }

    public function create($proceeding)
    {
    	$proceeding = $this->proceeding->find($proceeding);
    	
        return view('dashboard.article.create', compact('proceeding'));
    } 

    public function store()
    {
        $articles = $this->repository->store();

        return $articles;
    }

}
