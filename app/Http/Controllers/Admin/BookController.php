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

    public function storeAuthor($book, Request $request)
    {
        $book = $this->repository->storeAuthor($book, $request->user_email);

        return redirect(route('book.show', [$book->id, 'tab' => 'authors']))->with('success', 'The Author has been added!');
    }

    public function storeFile($book, Request $request)
    {
        $this->repository->storefile($book, $request->file('file'));

        return redirect(route('book.show', $book))->with('success', 'The file has been stored!');
    }
}
