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
        $article = $this->repository->store(request()->all());

        return redirect(route('proceeding.show', [$article->proceeding['id'], 'tab' => 'articles', 'sort' => 'created_at.desc']))->with('success', 'You have successfully created an article!');
    }

    public function show($article)
    {
        $articles = $this->repository->find($article);
        // return $articles->data;
        return view('dashboard.article.show',compact('articles'));
    }

}
