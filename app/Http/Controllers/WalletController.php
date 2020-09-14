<?php

namespace App\Http\Controllers;

use App\Coin;
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
        return view('user.dashboard.wallets.index', ['wallets' => $wallets]);
    }

    public function adminIndex(){
        $wallets = Wallet::where('is_special', 1)->paginate(10);
        return view('admin.wallet.index', ['wallets' => $wallets, 'search' => false]);
    }

    public function adminIndexWithCoin($coin){
        $coin = Coin::where('name', $coin)->first();
        $wallets = $coin->wallets()->where('is_special', 1)->paginate(10);
        return view('admin.wallet.index', ['wallets' => $wallets, 'coin' => $coin ,'search' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('user.dashboard.wallets.create');
    }

    public function adminCreate($coin){
        $coin = Coin::where('name', $coin)->first();
        return view('admin.wallet.create', compact('coin'));
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
            "wallet_address" => "required"
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

    public function adminStore(Request $request){
        $this->validate($request, [
            "coin" => "required",
            "company" => "required",
            "wallet_address" => "required"
        ]);
        if (Wallet::where('is_special', 1)->where('coin_id', $request->coin)->where('company', $request->company)->first()){
            return back()->with('error', 'You already have a '.$request->company.' wallet for this coin');
        }

        $coin = Coin::find($request->coin);

        $wallet = new Wallet;

        $wallet->user_id = Auth::user()->id;
        $wallet->coin_id = $request->coin;
        $wallet->company = $request->company;
        $wallet->address = $request->wallet_address;
        $wallet->is_special = 1;

        $wallet->save();

        return redirect()->route('admin.wallets.single', $coin->name)->with('message', 'Wallet added successfully');
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

    public function adminEdit(Wallet $wallet)
    {
        return view('admin.wallet.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
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

    public function adminUpdate(Request $request, Wallet $wallet)
    {
        $this->validate($request, [
            "company" => "required",
            "wallet_address" => "required|min:32|max:32"
        ]);

        if ($wallet->company !== $request->company){
            if (Wallet::where('is_special', 1)->where('coin_id', $wallet->coin->id)->where('company', $request->company)->first()){
                return back()->with('error', 'You already have a '.$request->company.' wallet for this coin');
            }
        }

        $wallet->company = $request->company;
        $wallet->address = $request->wallet_address;

        $wallet->update();

        return redirect()->route('admin.wallets.single', $wallet->coin->name)->with('message', 'Wallet updated successfully');
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

    public function adminDestroy(Wallet $wallet)
    {
        $wallet->delete();
        return redirect()->route('admin.wallets.single', $wallet->coin->name)->with('message', 'Wallet deleted successfully');
    }

    public function adminFilter(Request $request){
        $coin = Coin::where('name', 'like', '%'.$request->val.'%')->orWhere('abbr', 'like', '%'.$request->val.'%')->first();

        if ($coin){
            $wallets = Wallet::latest()->
            where('is_special', 1)->
            where('coin_id', $coin->id)->
            orWhere('address', 'like', '%'.$request->val.'%')->
            orWhere('company', 'like', '%'.$request->val.'%')->
            paginate(10);
        }else{
            $wallets = Wallet::latest()->
            where('is_special', 1)->
            Where('address', 'like', '%'.$request->val.'%')->
            orWhere('company', 'like', '%'.$request->val.'%')->
            paginate(10);
        }

        return view('admin.wallet.index', ['wallets' => $wallets, 'search' => true, 'val' => $request->val]);
    }

    public function getCompanies(Request $request){
        $coin = Coin::find($request->coin);

        $html = view('user.dashboard.partials.company', compact('coin'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }
}
