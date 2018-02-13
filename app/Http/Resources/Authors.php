<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Authors extends Resource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'affiliation' => $this->affiliation,
            'email' => $this->email,
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success'
        ];
    }
}
