<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlesRepository;
use App\Repositories\AuthorsRepository;
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
    	$lastArticle = $proceeding->articles->sortBy('created_at')->first();
    	
        return view('dashboard.article.create', compact('lastArticle', 'proceeding'));
    } 

    public function store()
    {
        $articles = $this->repository->store();

        return $articles;
    }

    public function show(AuthorsRepository $authors)
    {
        $authors = $authors->get()->data;
        // return $authors;
        return view('dashboard.article.author', compact('authors'));
    }

    public function find(Request $request, AuthorsRepository $authors)
    {
        $authors = $authors->get()->data;
        return $authors::search($request->get('name'));
    }

}
