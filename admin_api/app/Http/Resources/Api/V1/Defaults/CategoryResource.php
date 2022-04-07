<?php

namespace App\Http\Resources\Api\V1\Defaults;

use Illuminate\Http\Resources\Json\JsonResource;
use App\CustomPackages\ResourceAdvancedCodnitions\Traits\HasAdvancedConditions;

class CategoryResource extends JsonResource
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
            'type' => 'categories',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'created_at' => $this->created_at
            ],
            'links' => [
                'self' => route('categories') . '/' . $this->id
            ],
            'included' => $this->whenAnyLoaded([
                'operation' => new OperationResource($this->whenLoaded('operation')),
                'templates' => TemplateResource::collection($this->whenLoaded('templates')),
            ]),
        ];
    }
}
