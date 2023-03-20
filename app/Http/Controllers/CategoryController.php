<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class CategoryController extends Controller
{
    use ApiResponser;
    public function index(){
        return $this->successResponse(Category::all()->toArray());
    }

    public function get(Category $category){
        return $this->successResponse($category->toArray());

    }

    public function update(Category $category){

    }

    public function delete(Category $category){

    }

    public function create(CreateCategoryRequest $request){
        dd('create');
    }


}
