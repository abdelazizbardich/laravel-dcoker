<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Models\ApplicationToken;
use Hash;
use Validator;

class AuthController extends Controller
{
    public function authentificate(Request $request){
        try {
            $user = User::where('email',$request->email)->first();
            if($user == null){
                return response()->json("User not found!", 404);
            }
            if(!Hash::check($request->password, $user->password)){
                return response()->json("Worng password", 401);
            }
            $user->tokens()->delete();
            switch ($user->role) {
                case 'admin':
                    $role = ['admin'];
                    break;
                default:
                    $role = ['user'];
                    break;
            }
            $token = $user->createToken($user->email, $role);
            $user->token = $token->plainTextToken;
            $user->tokenid = $token->accessToken->id;
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
    }


    public function getAppToken(Request $request)
    {
        if(ApplicationToken::count() > 0){
            $Application = User::application()->where('email','application@email.com')->first();
            $Application->token = ApplicationToken::first()->token;
            return response()->json($Application, 200);
        }
        try {
            $Application = User::application()->where('email','application@email.com')->first();
            $token = $Application->createToken($Application->email, ['application']);
            $Application->token = $token->plainTextToken;
            $Application->tokenid = $token->accessToken->id;
            ApplicationToken::where("id",1)->updateOrCreate([
                "token" => $Application->token
            ]);
            return response()->json($Application, 200);
        } catch (Exception $th) {
            return response()->json($e->getMessage());
        }
    }



    // public function register(Request $request){
    //     $validator = Validator::make($request->all(),[
    //         "email" => "string|unique:users,email",
    //         "password" => "min:8"
    //     ]);
    //     if($validator->fails()){
    //         return response()->json($validator->errors());
    //     }
    //     try {
    //         $user = user::create([
    //             "name" => "test",
    //             "email" => $request->email,
    //             "password" => Hash::make($request->password)
    //         ]);
    //         $user->tokens()->delete();
    //         $user->token = $user->createToken($user->email, ['role:user'])->plainTextToken;
    //         return response()->json($user, 200);
    //     } catch (Exception $e) {
    //         return response()->json($e->getMessage());
    //     }
    // }
}
