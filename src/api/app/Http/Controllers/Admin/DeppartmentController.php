<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;

class DeppartmentController extends Controller
{
    public function index(){
        $data = [
            "deppartments" => user::user()->with(['category'])->get()
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "email" => "required|unique:users,email",
            "phones" => "required|array",
            "lat" => "required",
            "long" => "required",
            "logo" => "required",
            "password" => "required|min:8",
            "category" => "required|exists:categories,id",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "phones" => json_encode($request->phones),
                "lat" => $request->lat,
                "long" => $request->long,
                "logo" => $request->logo,
                "role" => "user",
                "categories_id" => $request->category,
                "password" => Hash::make($request->password)
            ]);
            $user->category = $user->category;
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    public function update(Request $request,User $user){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "email" => "required|unique:users,email,".$user->id,
            "phones" => "required|array",
            "lat" => "required",
            "long" => "required",
            "logo" => "required",
            "password" => "required|min:8",
            "category" => "required|exists:categories,id",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "phones" => json_encode($request->phones),
                "lat" => $request->lat,
                "long" => $request->long,
                "logo" => $request->logo,
                "role" => "user",
                "password" => Hash::make($request->password),
                "categories_id" => $request->category
            ]);
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    public function delete(User $user){
        try {
            $user->delete();
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
