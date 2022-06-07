<?php

namespace App\Http\Requests\Api\V1\ClientResources\Categories;

use App\CustomPackages\QueryRequest\KeyWords;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexCategoryRequest extends FormRequest
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
            KeyWords::FILTER => 'array:name,operation_id',
            KeyWords::INCLUDE => ['array', Rule::in(['operation', 'templates'])],
            KeyWords::SORT => ['string', Rule::in([
                'name-asc',
                'name-desc',
                'created_at-asc',
                'created_at-desc',
                'id-asc',
                'id-desc',
            ])],
            'paginate' => 'integer|min:1'
        ];
    }
}
