<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
class CategoryController extends Controller
{
    public function index(){
        $data = [
            "categoiries" => Category::all()
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:categories,id",
            "icon" => "required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $category = Category::create([
                "name" => $request->name,
                "icon" =>  $request->icon,
            ]);
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    public function update(Request $request,Category $category){
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:categories,id",
            "icon" => "required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $category->update([
                "name" => $request->name,
                "icon" => $request->icon,
            ]);
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    public function delete(Category $category){
        try {
            $category->delete();
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
