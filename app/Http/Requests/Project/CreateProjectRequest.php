<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type'  => 'required|string|max:255',
            'description' => 'sometimes|string|max:255',
            'contacts' => 'required|string|max:255',
            'avatar' => 'required|file|mimes:jpeg,jpg,png|max:10240', // 10mb=10240kb
            'ts' => 'required|mimes:pdf|max:51200', // 50mb=51200kb
        ];
    }
}
