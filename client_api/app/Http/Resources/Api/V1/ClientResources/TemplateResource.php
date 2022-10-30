<?php

namespace App\Http\Resources\Api\V1\ClientResources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\CustomPackages\ResourceAdvancedCodnitions\Traits\HasAdvancedConditions;

class TemplateResource extends JsonResource
{
    use HasAdvancedConditions;
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'templates',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'created_at' => $this->created_at
            ],
            'links' => [
                'self' => route('templates') . '/' . $this->id
            ],
            'included' => $this->whenAnyLoaded([
                'category' => new CategoryResource($this->whenLoaded('category')),
                'operation' => new OperationResource($this->whenLoaded('operation'))
            ]),
        ];
    }
}
