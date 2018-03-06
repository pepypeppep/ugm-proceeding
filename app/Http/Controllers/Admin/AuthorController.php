<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlesRepository;
use App\Repositories\AuthorsRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $repository;

    function __construct(AuthorsRepository $repository)
    {
    	$this->repository = $repository;
    }

    public function update($author)
    {
        $author = $this->repository->update(request()->except('article_id'), $author);

        return redirect(route('article.show', [request('article_id'), 'tab' => 'authors']))->with('success', 'Author '.$author->name.' has successfully updated');
    }
}
