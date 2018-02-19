<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @SWG\Definition(
 *      type="object",
 *      @SWG\Property(
 *          property="name",
 *          type="string",
 *          example="Proceeding of International Conference on Science and Technology"      
 *      ),
 *      @SWG\Property(
 *          property="alias",
 *          type="string",
 *          example="ICST 2017"      
 *      ),
 *      @SWG\Property(
 *          property="organizer",
 *          type="string",
 *          example="BPP UGM"      
 *      ),
 *      @SWG\Property(
 *          property="conference_start",
 *          type="date",
 *          example="2017-06-23"      
 *      ),
 *      @SWG\Property(
 *          property="conference_end",
 *          type="date",
 *          example="2017-06-24"      
 *      ),
 * )
 */
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
            'id' => $this->id,
            'name' => $this->name,
            'alias' => $this->alias,
            'introduction' => $this->introduction,
            'front_cover' => $this->front_cover_url,
            'back_cover' => $this->back_cover_url,
            'status' => $this->status,
            'identifiers' => $this->identifiers,
            'location' => $this->location,
            'organizer' => $this->organizer,
            'subjects' => Subjects::collection($this->subject),
            'date' => [
                'conference_start' => $this->conference_start->toDateString(),
                'conference_end' => $this->conference_end->toDateString(),
                'published' => optional($this->published_at)->toDateString(),
            ],
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
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
