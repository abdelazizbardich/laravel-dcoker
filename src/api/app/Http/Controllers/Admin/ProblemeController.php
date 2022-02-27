<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
use Validator;

class ProblemeController extends Controller
{
    public function index(){
        $data = [
            "problemes" => Problem::with(['repport'])->get()
        ];
        return response()->json($data, 200);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:problems,id",
            "icon" => "required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $problem = Problem::create([
                "name" => $request->name,
                "icon" =>  $request->icon,
            ]);
            return response()->json($problem->with(['repport'])->first(), 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    public function update(Request $request,Problem $problem){
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:problems,id",
            "icon" => "required",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $problem->update([
                "name" => $request->name,
                "icon" => $request->icon,
            ]);
            return response()->json($problem, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    public function delete(Problem $problem){
        try {
            $problem->delete();
            return response()->json($problem, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
