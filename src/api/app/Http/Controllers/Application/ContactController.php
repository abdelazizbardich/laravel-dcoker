<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "message" => "required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $category = Category::create([
                "name" => $request->name,
                "message" =>  $request->icon,
            ]);
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
