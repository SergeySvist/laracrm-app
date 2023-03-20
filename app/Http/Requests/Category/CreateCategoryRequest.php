<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:64',
        ];
    }
}
