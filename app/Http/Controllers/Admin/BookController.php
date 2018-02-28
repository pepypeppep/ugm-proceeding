<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BooksRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function __construct(BooksRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $books = $this->repository->getAll();
        return view('dashboard.book.index', compact('books'));
    }

    public function show($book)
    {
        $book = $this->repository->find($book);

        return view('dashboard.book.show', compact('book'));
    }

    public function create()
    {
        return view('dashboard.book.create');
    }

    public function store(Request $request)
    {
        $book = $this->repository->store($request->all());

        return redirect(route('book.show', $book->id));
    }
}
