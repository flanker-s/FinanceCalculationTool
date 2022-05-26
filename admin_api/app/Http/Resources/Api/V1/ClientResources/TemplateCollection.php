<?php

namespace App\Http\Resources\Api\V1\ClientResources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TemplateCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'links' => [
                'self' => route('templates')
            ],
            'data' => $this->collection
        ];
    }
}
