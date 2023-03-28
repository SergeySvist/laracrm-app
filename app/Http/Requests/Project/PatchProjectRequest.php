<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class PatchProjectRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type'  => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:255',
            'contacts' => 'sometimes|string|max:255',
            'avatar' => 'sometimes|file|mimes:jpeg,jpg,png|max:10240', // 10mb=10240kb
            'ts' => 'sometimes|mimes:pdf|max:51200', // 50mb=51200kb

        ];
    }
}
