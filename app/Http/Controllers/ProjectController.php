<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\DownloadProjectRequest;
use App\Http\Requests\Project\PatchProjectRequest;
use App\Models\Project;
use App\Services\Files\FileService;
use App\Services\Files\Zip\ZipService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProjectController extends Controller
{
    use ApiResponser;

    const ZIP_FILE_NAME = 'Project_files.zip';

    public function create(CreateProjectRequest $request, FileService $fileService){
        $project = new Project($request->validated());

        $avatar = $fileService->save($request['avatar']);
        $project->avatar_file_id = $avatar->id;

        $ts = $fileService->save($request['ts']);
        $project->ts_file_id = $ts->id;

        $project->save();

        return $this->successResponse($project->toArray(), null, Response::HTTP_CREATED);
    }

    public function patch(Project $project, PatchProjectRequest $request, FileService $fileService){
        $project->fill($request->validated());

        if (isset($request['avatar'])){
            $fileService->delete($project->avatarFile);

            $file = $fileService->save($request['avatar']);
            $project->avatar_file_id = $request['avatar'];
        }
        $project->save();
    }

    public function get(Project $project): JsonResponse{
        return $this->successResponse($project->toArray());
    }

    public function delete(Project $project, FileService $fileService): JsonResponse{
        $fileService->delete($project->avatarFile);
        $fileService->delete($project->tsFile);

        $project->delete();

        return $this->successResponse([], null, Response::HTTP_NO_CONTENT);
    }

    public function download(Project $project, DownloadProjectRequest $request, FileService $fileService, ZipService $zipService){
        switch ($request->validated('file')){
            case Project::DOWNLOAD_FILE_AVATAR:
                return $fileService->getStream($project->avatarFile);
                break;
            case Project::DOWNLOAD_FILE_TS:
                return $fileService->getStream($project->tsFile);
                break;
            case Project::DOWNLOAD_FILE_ZIP:
                $zip = $zipService->compress($project->getAllFiles(), self::ZIP_FILE_NAME);
                return response()->download($zip)->deleteFileAfterSend(true);
                break;
        }
        return null;
    }
}
