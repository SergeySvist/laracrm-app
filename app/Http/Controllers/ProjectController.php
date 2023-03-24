<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Models\Project;
use App\Services\Files\FileService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    use ApiResponser;
    public function create(CreateProjectRequest $request, FileService $fileService){
        $project = new Project($request->validated());

        $avatar = $fileService->save($request['avatar']);
        $project->avatar_file_id = $avatar->id;

        $ts = $fileService->save($request['ts']);
        $project->ts_file_id = $ts->id;

        $project->save();

        return $this->successResponse($project->toArray(), null, Response::HTTP_CREATED);
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
}
