<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Identifiers extends Resource
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
            'type' => $this->type,
            'code' => $this->when($this->pivot, $this->pivot->code),
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }
}
