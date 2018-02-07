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
            'id' => $this->id,
            'abstract' => $this->abstract,
            'authors' => Authors::collection($this->author),
            'cites' => $this->cites,
            'date_added' => $this->created_at->format('j F Y'),
            'downloads' => $this->downloads,
            'end_page' => $this->end_page,
            'identifiers' => $this->getIdentifiers(),
            'indexed' => $this->indexed,
            'file' => $this->getFile(),
            'keywords' => $this->setKeywords(),
            'proceeding' => $this->when(!$this->checkUrl('proceedings'), new Proceedings($this->proceeding)),
            'start_page' => $this->start_page,
            'title' => $this->title,
            'views' => $this->views,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success'
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
