<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Articles extends Resource
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
            'title' => $this->title,
            'abstract' => $this->abstract,
            'keywords' => $this->keywords,
            'start_page' => $this->start_page,
            'end_page' => $this->end_page,
            'views' => $this->view,
            'downloads' => $this->downloads,
            'cites' => $this->cites,
            'identifier' => $this->article_identifier()->get(['type', 'code']),
            'authors' => $this->whenLoaded('author'),
            'date_added' => $this->created_at->format('j F Y'),
        ];
    }
}
