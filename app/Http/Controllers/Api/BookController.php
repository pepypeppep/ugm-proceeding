<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Book $book)
    {
        return Books::collection($book->all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string|max:500',
            'category' => 'string|max:20',
            'edition' => 'nullable|integer',
            'pages' => 'nullable|integer',
            'publication_year' => 'required',
            'publisher' => 'required|string',
        ]);

        $book = Book::create($data);

        return $book;
    }
}
