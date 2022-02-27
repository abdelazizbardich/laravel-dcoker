<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DeppartmentController extends Controller
{
    

    public function index()
    {
        $data = [
            "centers" => User::user()->get()
        ];
        return response()->json($data, 200);
    }
}
