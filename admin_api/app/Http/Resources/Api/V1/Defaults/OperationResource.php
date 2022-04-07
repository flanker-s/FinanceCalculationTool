<?php

namespace App\Http\Resources\Api\V1\Defaults;

use Illuminate\Http\Resources\Json\JsonResource;
use App\CustomPackages\ResourceAdvancedCodnitions\Traits\HasAdvancedConditions;

class OperationResource extends JsonResource
{
    use HasAdvancedConditions;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'operations',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
            ],
            'included' => $this->whenAnyLoaded([
                'categories' => CategoryResource::collection($this->whenLoaded('categories')),
                'templates' => TemplateResource::collection($this->whenLoaded('templates')),
            ]),
        ];
    }
}
