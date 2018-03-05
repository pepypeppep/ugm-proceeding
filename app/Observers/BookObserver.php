<?php

namespace App\Observers;

use App\Book;
use App\Identifier;

/**
* Book Observer
*/
class BookObserver
{
    public function created(Book $book)
    {
        $identifier = new Identifier;

        $book->identifiers()->attach($identifier->getIdentifierId('Book'));
    }
}
