<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Market;
use App\Trade;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:coins,name',
            'short_name' => 'required|unique:coins,abbr',
            'logo' => 'required|mimes:png,jpeg,jpg'
        ]);

        $file = $request->logo;
        $file_name = $file->getClientOriginalName();

        $destinationPath = public_path('/images');

        $file->move($destinationPath, $file_name);

        $coin = new Coin;

        $coin->name = $request->name;
        $coin->abbr = $request->short_name;
        $coin->logo = $file_name;
        $coin->save();
        return back()->with('message', 'Coin added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function show(Coin $coin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function edit(Coin $coin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coin $coin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coin  $coin
     */
    public function destroy(Coin $coin)
    {
        if (Market::where('coin_id', $coin->id)->count() > 0){
            return back()->with('error', 'Coin already used in transaction records');
        }
        if (Trade::where('coin_id', $coin->id)->count() > 0){
            return back()->with('error', 'Coin already used in transaction records');
        }
        $coin->delete();
        unlink('images/'.$coin->logo);
        return back()->with('message', 'Coin deleted successfully');
    }
}
