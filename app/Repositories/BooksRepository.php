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

    public function find($book)
    {
        $this->getResponse('GET', $this->uris['base']."/$book");

        return $this;
    }

    public function store($json)
    {
        $this->json = $json;

        $this->getResponse('POST', $this->uris['base']);

        return $this;
    }

    public function storeAuthor($book, $email)
    {
        $this->json = [
            'user_email' => $email,
        ];

        $this->getResponse('POST', $this->uris['base']."/$book/author");

        return $this;
    }

    public function storeFile($book, $file)
    {
        $this->multipart= array([
            'name' => 'file',
            'contents' => fopen($file, 'r'),
        ]);

        $this->getResponse('POST', $this->uris['base']."/$book/file");

        return $this;
    }
}
