<?php

namespace App\Http\Requests\Api;

use App\CustomPackages\QueryRequest\KeyWords;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserAuthenticationRequest extends FormRequest
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
        return [
            KeyWords::INCLUDE => ['array', Rule::in(['abilities'])]
        ];
    }
}
