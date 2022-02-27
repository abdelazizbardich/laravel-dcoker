<?php

namespace App\Http\Controllers\Deppartment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repport;
use Validator;

class RepportController extends Controller
{
    //
    public function index(){
        $data = [
            "repports" => Repport::with(["problem"])->get()
        ];
        return response()->json($data, 200);
    }

    // set as Solved
    public function solved(Repport $repport){
        try {
            $repport->update([
                "solved" => true
            ]);
            return response()->json($repport, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
