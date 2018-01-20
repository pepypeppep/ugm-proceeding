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
            'keywords' => $this->setKeywords(),
            'start_page' => $this->start_page,
            'end_page' => $this->end_page,
            'views' => $this->view,
            'downloads' => $this->downloads,
            'cites' => $this->cites,
            'identifiers' => $this->identifiers,
            'authors' => $this->whenLoaded('author'),
            'proceeding' => $this->when(!$this->checkUrl('proceedings'), new Proceedings($this->proceeding)),
            'date_added' => $this->created_at->format('j F Y'),
        ];
    }

    /**
     * Check if the current url contains the given string
     * @param  string $url 
     * @return bool
     */
    public function checkUrl($url)
    {
        return str_contains(url()->current(), $url);
    }
}
