<?php

namespace App\Http\Requests\Api\V1\ClientResources\Categories;

use App\Rules\OperationExists;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required',
            'operation_id' => ['required', 'numeric', new OperationExists()]
        ];
    }
}
