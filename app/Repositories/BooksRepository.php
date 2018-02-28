<?php

namespace App\Repositories;

use App\Services\GuzzleService;

/**
* Books repository
*/
class BooksRepository extends GuzzleService
{
    
    protected $uris = [
        'base' => 'books',
    ];

    public function getAll()
    {
        $this->getResponse('GET', $this->uris['base']);

        return $this;
    }
}
