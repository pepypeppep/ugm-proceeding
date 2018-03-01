<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\BooksRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $repository;

    function __construct(BooksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {

        $books = $this->repository->getAll();

    	return view('public.home.books', compact('books'));
    }

    public function show($book)
    {
        $book = $this->repository->find($book);

    	return view('public.home.book-show', compact('book'));
    }
}
