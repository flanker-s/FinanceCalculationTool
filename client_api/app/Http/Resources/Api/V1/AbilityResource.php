<?php

namespace App\Http\Resources\Api\V1;

use App\CustomPackages\ResourceAdvancedCodnitions\Traits\HasAdvancedConditions;
use Illuminate\Http\Resources\Json\JsonResource;

class AbilityResource extends JsonResource
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
            'type' => 'abilities',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name
            ],
            'links' => [
                'self' => route('abilities') . '/' . $this->id
            ],
            'included' => $this->whenAnyLoaded([
                'users' => UserResource::collection($this->whenLoaded('users'))
            ])
        ];
    }
}
