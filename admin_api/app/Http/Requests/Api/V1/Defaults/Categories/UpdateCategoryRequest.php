<?php

namespace App\Http\Requests\Api\V1\Defaults\Categories;

use App\Rules\OperationExists;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => '',
            'operation_id' => ['numeric', new OperationExists()]
        ];
    }
}
