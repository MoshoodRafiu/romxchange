<?php

namespace App\Http\Controllers;

use App\Market;
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
        return view('admin.index');
    }
}
