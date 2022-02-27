<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repport;
use Validator;

class RepportController extends Controller
{
    //
    public function index(){
        $data = [
            "repports" => Repport::with(['problem'])->get()
        ];
        return response()->json($data, 200);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "lat" => "required",
            "long" => "required",
            "probleme" => "required|exists:problems,id",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $repport = Repport::create([
                "lat" => $request->lat,
                "long" => $request->long,
                "solved" => false,
                "problems_id" => $request->probleme
            ]);
            return response()->json($repport, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    public function update(Request $request,Repport $repport){
        $validator = Validator::make($request->all(),[
            "lat" => "required",
            "long" => "required",
            "solved" => "required",
            "probleme" => "required|exists:problems,id",
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        try {
            $repport->update([
                "lat" => $request->lat,
                "long" => $request->long,
                "solved" => $request->solved,
                "problems_id" => $request->probleme
            ]);
            return response()->json($repport, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }

    public function delete(Repport $repport){
        try {
            $repport->delete();
            return response()->json($repport, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
