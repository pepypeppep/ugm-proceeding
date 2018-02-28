<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlesRepository;
use App\Repositories\ProceedingsRepository;
use Illuminate\Http\Request;

class ProceedingController extends Controller
{
    protected $repository;
    protected $article;

    function __construct(ProceedingsRepository $repository, ArticlesRepository $article)
    {
        $this->repository = $repository;
        $this->article = $article;
    }

    public function index()
    {
        $proceedings = $this->repository->get();
        $articles = $this->article->get();

    	return view('public.home.proceedings', compact('proceedings','articles'));
    }
}
