<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Proceedings extends Resource
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
            'name' => $this->name,
            'alias' => $this->alias,
            'introduction' => $this->introduction,
            'front_cover' => $this->front_cover,
            'back_cover' => $this->back_cover,
            'status' => $this->status,
            'isbn' => $this->isbn,
            'organizer' => $this->organizer,
            'subjects' => $this->subject->pluck('name'),
            'editors' => optional($this->editor)->pluck(['name']),
            'date' => [
                'conference_start' => $this->conference_start->format('j F y'),
                'conference_end' => $this->conference_end->format('j F y'),
                'published' => $this->published_at,
            ],
            'total_articles' => $this->article()->count(),
            'articles' => Articles::collection($this->whenLoaded('article')),
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success'
        ];
    }
}
