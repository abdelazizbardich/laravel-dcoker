<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    

    public function index(){
        $data = [
            "categoiries" => Category::all()
        ];
        return response()->json($data, 200);
    }
}
