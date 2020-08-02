<?php

namespace App\Http\Controllers;

use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $wallets = Auth::user()->wallets;
        return view('user.dashboard.wallets.index', compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.dashboard.wallets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "coin" => "required",
            "company" => "required",
            "wallet_address" => "required|min:32|max:32"
        ]);
        if (Wallet::where('user_id', Auth::user()->id)->where('coin_id', $request->coin)->first()){
            return back()->with('error', 'You already have a wallet for this coin');
        }

        $wallet = new Wallet;

        $wallet->user_id = Auth::user()->id;
        $wallet->coin_id = $request->coin;
        $wallet->company = $request->company;
        $wallet->address = $request->wallet_address;

        $wallet->save();

        return redirect()->route('wallet.index')->with('message', 'Wallet added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wallet  $wallet
     */
    public function edit(Wallet $wallet)
    {
        return view('user.dashboard.wallets.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        $this->validate($request, [
            "company" => "required",
            "wallet_address" => "required|min:32|max:32"
        ]);

        $wallet->company = $request->company;
        $wallet->address = $request->wallet_address;

        $wallet->update();

        return redirect()->route('wallet.index')->with('message', 'Wallet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     */
    public function destroy(Wallet $wallet)
    {
        $wallet->delete();
        return redirect()->route('wallet.index')->with('message', 'Wallet deleted successfully');
    }
}
