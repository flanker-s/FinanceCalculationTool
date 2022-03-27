<?php

namespace App\Http\Resources\Api\v1\Templates;

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
            'operation_type' => $this->operation_type,
            'created_at' => $this->created_at,
            'templates' => TemplateResource::collection($this->whenLoaded('templates'))
        ];
    }
}
