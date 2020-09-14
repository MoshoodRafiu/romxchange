<?php

namespace App\Http\Controllers;

use App\Trade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    public function index(){
        $date = date('Y-m-d', strtotime(now()));
        $res = DB::select("SELECT WEEKOFYEAR('".$date."') AS current");
        $currentWeek =  $res[0]->current;
        $trades = Trade::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        return view('admin.analysis', compact('trades', 'currentWeek'));
    }
}
