<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlesRepository;
use App\Repositories\AuthorsRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $repository;

    function __construct(ArticlesRepository $repository)
    {
    	$this->repository = $repository;
    }

    public function update($author)
    {
        return request()->all();
    }
}
