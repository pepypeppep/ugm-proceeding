<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProceedingsRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $repository;

    function __construct(ProceedingsRepository $repository)
    {
    	$this->repository = $repository;
    }

    public function create($proceeding)
    {
    	$proceeding = $this->repository->find($proceeding);
    	
        return view('dashboard.proceeding.createarticle', compact('proceeding'));
    }
}
