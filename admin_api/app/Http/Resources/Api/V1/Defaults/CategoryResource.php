<?php

namespace App\Http\Resources\Api\V1\Defaults;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'operation' => $this->operation,
            'created_at' => $this->created_at,
            'templates' => TemplateResource::collection($this->whenLoaded('templates'))
        ];
    }
}
