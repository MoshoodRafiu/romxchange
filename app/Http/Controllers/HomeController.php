<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Market;
use App\Trade;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $markets = Market::all()->take(10);
        return view('user.index', compact('markets'));
    }

    public function adminDashboard(){
        $trades = Trade::all();
        $coins = Coin::all();
        return view('admin.index', compact('trades', 'coins'));
    }
}
