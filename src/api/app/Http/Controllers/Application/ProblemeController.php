<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
class ProblemeController extends Controller
{

    public function index(){
        $data = [
            "problems" => Problem::all()
        ];
        return response()->json($data, 200);
    }
}
