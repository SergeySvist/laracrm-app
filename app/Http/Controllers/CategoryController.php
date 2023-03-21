<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryPatchRequest;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    use ApiResponser;
    public function index(){
        return $this->successResponse(Category::all()->toArray());
    }

    public function get(Category $category){
        return $this->successResponse($category->toArray());

    }

    public function update(Category $category,  CategoryPatchRequest $request){
        $category->update($request->validated());

        return $this->successResponse([], null, Response::HTTP_NO_CONTENT);
    }

    public function delete(Category $category){
        //todo: cascade update ???
        $category->delete();

        return $this->successResponse([], null, Response::HTTP_NO_CONTENT);
    }

    public function create(CreateCategoryRequest $request){
        $category = Category::create($request->validated());

        return $this->successResponse(['id' => $category->id], null, Response::HTTP_CREATED);
    }


}
