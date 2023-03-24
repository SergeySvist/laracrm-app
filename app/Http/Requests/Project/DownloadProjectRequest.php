<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class DownloadProjectRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'required|string|in:' . Project::DOWNLOAD_FILE_AVATAR .','. Project::DOWNLOAD_FILE_TS .','. Project::DOWNLOAD_FILE_ZIP,
        ];
    }
}
