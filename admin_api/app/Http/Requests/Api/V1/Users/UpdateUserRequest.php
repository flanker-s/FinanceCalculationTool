<?php

namespace App\Http\Requests\Api\V1\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userAbilityIds = $this->user()->abilities->pluck('id')->filter(function ($value){
            return $value != null;
        })->all();

        return [
            'name' => '',
            'email' => 'email',
            'password' => 'min:6',
            'abilities' => ['array', Rule::in($userAbilityIds)]
        ];
    }
}
