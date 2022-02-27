<?php

namespace App\Http\Controllers\Deppartment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function authentificate(Request $request){
        try {
            $user = User::where('email',$request->email)->first();
            if($user == null){
                throw new Exception("User not found!", 404);
            }
            if(!Hash::check($request->password, $user->password)){
                throw new Exception("Worng password", 401);
            }
            $user->tokens()->delete();
            $token = $user->createToken($user->email, ['deppartment']);
            $user->token = $token->plainTextToken;
            $user->tokenid = $token->accessToken->id;
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            "email" => "string|unique:users,email",
            "password" => "min:8"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        try {
            $user = user::create([
                "name" => "test",
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);
            $user->tokens()->delete();
            $user->token = $user->createToken($user->email, ['role:user'])->plainTextToken;
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }        
    }
}
