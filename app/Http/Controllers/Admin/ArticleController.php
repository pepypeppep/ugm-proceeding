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
    protected $proceeding;

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
        $article = $this->repository->find($article);

        return view('dashboard.article.show', compact('article'));
    }

    public function edit($article)
    {
        $article = $this->repository->find($article);

        return view('dashboard.article.edit', compact('article'));
    }

    public function update($article)
    {
        $article = $this->repository->update(request()->all(), $article);

        return redirect(route('article.edit', ['article' => $article->id]))->with('success', $article->name.' has been updated!');
    }

}
