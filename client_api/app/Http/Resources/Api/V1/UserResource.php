<?php

namespace App\Http\Resources\Api\V1;

use App\CustomPackages\ResourceAdvancedCodnitions\Traits\HasAdvancedConditions;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'users',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'created_at' => $this->created_at,
            ],
            'included' => $this->whenAnyLoaded([
                'abilities' => AbilityResource::collection($this->whenLoaded('abilities'))
            ]),
            'links' => [
                'self' => route('users') . '/' . $this->id
            ]
        ];
    }
}
