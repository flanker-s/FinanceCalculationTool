<?php

namespace App\Http\Requests\Api\V1\Defaults\Templates;

use App\Rules\CategoryExists;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTemplateRequest extends FormRequest
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
            'name' => '',
            'category_id' => ['numeric', new CategoryExists()],
        ];
    }
}
