<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @SWG\Definition(
 *      type="object",
 *      @SWG\Property(
 *          property="name",
 *          type="string",
 *          example="Forestry"      
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          type="date",
 *          example="2018-01-22"      
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          type="date",
 *          example="2018-01-22"      
 *      ),
 * )
 */
class Subjects extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => [
                'created_at' => $this->created_at->format('j F y'),
                'updated_at' => $this->updated_at->format('j F y'),
            ],
        ];
    } 

    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }
}
