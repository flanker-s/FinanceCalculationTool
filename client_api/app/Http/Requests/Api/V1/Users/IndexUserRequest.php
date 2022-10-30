<?php

namespace App\Http\Requests\Api\V1\Users;

use App\CustomPackages\QueryRequest\KeyWords;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            KeyWords::FILTER => 'array:name,email',
            KeyWords::INCLUDE => ['array', Rule::in(['abilities'])],
            KeyWords::SORT => ['string', Rule::in([
                'name-asc',
                'name-desc',
                'email-asc',
                'email-desc',
                'created_at-asc',
                'created_at-desc',
                'id-asc',
                'id-desc',
            ])],
            'paginate' => 'integer|min:1'
        ];
    }
}
