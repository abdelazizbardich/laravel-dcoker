<?php

namespace App\Http\Controllers\Deppartment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Repport;

class HomeController extends Controller
{
    // index
    public function index(){
        $data = [
            "reports" => Repport::count(),
            "solved" => Repport::where("solved",true)->count(),
            "statistics" => [
                Repport::whereYear("created_at","2022")->whereMonth("created_at","01")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","02")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","03")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","04")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","05")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","06")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","07")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","08")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","09")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","10")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","11")->count(),
                Repport::whereYear("created_at","2022")->whereMonth("created_at","12")->count()
            ]
        ];
        return response()->json($data, 200);
    }
}
