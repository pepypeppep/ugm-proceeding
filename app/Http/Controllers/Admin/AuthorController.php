<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlesRepository;
use App\Repositories\AuthorsRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $repository;
    protected $author;

    function __construct(ArticlesRepository $repository, AuthorsRepository $author)
    {
    	$this->repository = $repository;
    	$this->author = $author;
    }

    public function update($author)
    {
        return request()->all();
    }
}
