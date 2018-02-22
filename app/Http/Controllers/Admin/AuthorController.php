<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlesRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $repository;

    function __construct(ArticlesRepository $repository)
    {
    	$this->repository = $repository;
    }

    public function edit($article)
    {
        $article = $this->repository->find($article);
        return view('dashboard.article.edit-author', compact('article'));
    }
}
