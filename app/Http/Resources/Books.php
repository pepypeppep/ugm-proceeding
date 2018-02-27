<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Books extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => [
                $this->category,
            ],
            'edition' => $this->edition,
            'pages' => $this->pages,
            'publication_year' => $this->publication_year,
            'publisher' => $this->publisher,
            'authors' => $this->author,
            'identifiers' => [
                [
                    'type' => 'isbn',
                    'id' => $this->isbn,
                ],
            ],
            'download' => $this->file,
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }
}
