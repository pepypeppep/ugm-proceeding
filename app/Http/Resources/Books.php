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
            'cover' => $this->cover,
            'category' => [
                $this->category,
            ],
            'edition' => $this->edition,
            'pages' => $this->pages,
            'publication_year' => $this->publication_year,
            'publisher' => $this->publisher,
            'file' => $this->when(optional(auth('api')->user())->isSuperAdmin(), $this->file),
            'authors' => BookAuthors::collection($this->author),
            'identifiers' => [
                [
                    'type' => 'isbn',
                    'id' => $this->isbn,
                ],
            ],
            'download' => $this->getDownloadLink(),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }

    public function getDownloadLink()
    {
        $user = optional(auth('api')->user())->id;

        if ($this->hasAuthor($user)) {
            return route('api.book.download', $this->id);
        }

        return null;
    }
}
