<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repport;
use Validator;

class RepportController extends Controller
{

    public function index(){
        $data = [
            "repports" => Repport::with(['problem'])->get()
        ];
        return response()->json($data, 200);
    }
    public function report(Request $request){
        $validator = Validator::make($request->all(),[
            "lat" => "required",
            "long" => "required",
            "type" => "required|exists:problems,id",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $repports = Repport::create([
                "lat" => $request->lat,
                "long" => $request->long,
                "problems_id" => $request->type
            ]);
            return response()->json($repports, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
