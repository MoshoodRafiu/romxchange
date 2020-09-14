<?php

namespace App\Http\Controllers;

use App\Coin;
use App\User;
use App\Market;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $markets = Market::orderBy('is_special', 'desc')->withCount(['reviews as star_rating' => function($query) {
            $query->select(DB::raw('coalesce(avg(star),0)'));
        }])->orderByDesc('star_rating')->paginate(8);

        return view('user.market', compact('markets'));
    }

    public function adminMarket(){
        $markets = Market::latest()->orderBy('is_special', 'DESC')->paginate(10);
        return view('admin.market.index', ['markets' => $markets, 'search' => false]);
    }

    public function adminMarketFilter(Request $request){

        $user = User::where('display_name', 'like', '%'.$request->val.'%')->first();
        $coin = Coin::where('abbr', 'like', '%'.$request->val.'%')->first();

        if ($user && $coin){
            $markets = Market::latest()->
            where('user_id', 'like', '%'.$user->id.'%')->
            orWhere('coin_id', 'like', '%'.$coin->id.'%')->
            orWhere('type', 'like', '%'.$request->val.'%')->
            orWhere('min', 'like', '%'.$request->val.'%')->
            orWhere('max', 'like', '%'.$request->val.'%')->
            orWhere('price_ngn', 'like', '%'.$request->val.'%')->
            orderBy('is_special', 'DESC')->
            paginate(10);
        }elseif ($user && !$coin){
            $markets = Market::latest()->
            where('user_id', 'like', '%'.$user->id.'%')->
            orWhere('type', 'like', '%'.$request->val.'%')->
            orWhere('min', 'like', '%'.$request->val.'%')->
            orWhere('max', 'like', '%'.$request->val.'%')->
            orWhere('price_ngn', 'like', '%'.$request->val.'%')->
            orderBy('is_special', 'DESC')->
            paginate(10);
        }elseif (!$user && $coin){
            $markets = Market::latest()->
            where('coin_id', 'like', '%'.$coin->id.'%')->
            orWhere('type', 'like', '%'.$request->val.'%')->
            orWhere('min', 'like', '%'.$request->val.'%')->
            orWhere('max', 'like', '%'.$request->val.'%')->
            orWhere('price_ngn', 'like', '%'.$request->val.'%')->
            orderBy('is_special', 'DESC')->
            paginate(10);
        }else{
            $markets = Market::latest()->
            where('type', 'like', '%'.$request->val.'%')->
            orWhere('min', 'like', '%'.$request->val.'%')->
            orWhere('max', 'like', '%'.$request->val.'%')->
            orWhere('price_ngn', 'like', '%'.$request->val.'%')->
            orderBy('is_special', 'DESC')->
            paginate(10);
        }
        return view('admin.market.index', ['markets' => $markets, 'search' => true, 'val' => $request->val]);
    }

    public function buy()
    {
        $markets = Market::where('type', 'sell')->paginate(5);
        return view('user.market', compact('markets'));
    }
    public function sell()
    {
        $markets = Market::where('type', 'buy')->paginate(5);
        return view('user.market', compact('markets'));
    }

    public function userMarket(){
        $markets = Market::where('user_id', Auth::user()->id)->get();
        return view('user.dashboard.adverts.index', compact('markets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $coins = Coin::all();
        return view('user.dashboard.adverts.create', compact('coins'));
    }

    public function adminMarketCreate(){
        $coins = Coin::all();
        return view('admin.market.create', compact('coins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        if (!$this->userHasVerification()){
            return back()->with('error', 'You have to verify your account before creating an advert');
        }

        $this->validate($request, [
            "coin" => "required|min:1",
            "type" => "required|string",
            "min" => "required|numeric",
            "max" => "required|numeric",
            "rate" => "required|numeric",
        ]);

        if ($request->type === "buy"){
            if (!$this->userBuyVerified()){
                return back()->with('error', 'You have to verify your phone number and documents before creating a buy advert');
            }elseif (!$this->buyerWallet($request->coin)){
                return back()->with('error', 'You do not have a wallet for this coin, please add a wallet and try again later');
            }
        }elseif ($request->type === "sell"){
            if (!$this->userSellVerified()){
                return back()->with('error', 'You have to verify your phone number before creating a sell advert');
            }elseif (!$this->sellerAccount()){
                return back()->with('error', 'Cant create advert, fill in your BANK DETAILS in PROFILE and try again');
            }
        }

        if (Market::where('user_id', Auth::user()->id)->where('coin_id', $request->coin)->where('type', $request->type)->first()){
            return back()->with('error', 'You already have a '.$request->type.' advert for this coin');
        }
        Market::create([
            'user_id' => Auth::user()->id,
            'coin_id' => $request->coin,
            'type' => $request->type,
            'min' => $request->min,
            'max' => $request->max,
            'rate' => $request->rate,
        ]);

        return redirect()->route('market.user')->with('message', 'Advert added successfully');
    }

    public function adminMarketStore(Request $request){
        $this->validate($request, [
            "coin" => "required|min:1",
            "type" => "required|string",
            "min" => "required|numeric",
            "max" => "required|numeric",
            "rate" => "required|numeric",
        ]);

        if ($request->type === "buy"){
            if (!$this->buyerWallet($request->coin)){
                return back()->with('error', 'You do not have a wallet for this coin, please add a wallet and try again later');
            }
        }elseif ($request->type === "sell"){
           if (!$this->sellerAccount()){
                return back()->with('error', 'You need to update bank details before creating a market');
            }
        }

        if (Market::where('user_id', Auth::user()->id)->where('is_special', 1)->where('coin_id', $request->coin)->where('type', $request->type)->first()){
            return back()->with('error', 'You already have a '.$request->type.' advert for this coin');
        }

        Market::create([
            'user_id' => Auth::user()->id,
            'coin_id' => $request->coin,
            'is_special' => 1,
            'type' => $request->type,
            'min' => $request->min,
            'max' => $request->max,
            'rate' => $request->rate,
        ]);

        return redirect()->route('admin.markets')->with('message', 'Market created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Market  $market
     */
    public function show(Market $market)
    {

    }


    public function edit(Market $market)
    {
        $coins = Coin::all();
        return view('user.dashboard.adverts.edit', compact(['market', 'coins']));
    }

    public function adminMarketEdit(Market $market)
    {
        $coins = Coin::all();
        return view('admin.market.edit', compact(['market', 'coins']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Market  $market
     */
    public function update(Request $request, Market $market)
    {
        $this->validate($request, [
            "min" => "required|numeric",
            "max" => "required|numeric",
            "rate" => "required|numeric",
        ]);

        $market->update([
            'min' => $request->min,
            'max' => $request->max,
            'rate' => $request->price_usd,
        ]);

        return redirect()->route('market.user')->with('message', 'Advert updated successfully');
    }

    public function adminMarketUpdate(Request $request, Market $market)
    {
        $this->validate($request, [
            "min" => "required|numeric",
            "max" => "required|numeric",
            "rate" => "required|numeric",
        ]);

        $market->update([
            'min' => $request->min,
            'max' => $request->max,
            'rate' => $request->rate,
        ]);

        return redirect()->route('admin.markets')->with('message', 'Market updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Market  $market
     */
    public function destroy(Market $market)
    {
        $market->delete();
        return redirect()->route('market.user')->with('message', 'Advert deleted successfully');
    }

    public function adminMarketDelete(Market $market){
        $market->delete();
        return back()->with('message', 'Market deleted successfully');
    }

    public function filterMarket(Request $request){
        if (!$request->volume){
            $markets = Market::where('type', '!=', $request->type)->where('coin_id', $request->coin)->paginate(5);
        }else{
            $this->validate($request, [
                'volume' => 'numeric'
            ]);
            $markets = Market::where('type', '!=', $request->type)->where('coin_id', $request->coin)
                ->whereRaw('CAST(`min` AS SIGNED) <= ?', (int) $request->volume)
                ->whereRaw('CAST(`max` AS SIGNED) >= ?', (int) $request->volume)->paginate(5);
        }
        return view('user.market', compact('markets'));
    }

    protected function userHasVerification(){
        if (Auth::user()->verification){
            return true;
        }
    }

    protected function userSellVerified(){
        if (Auth::user()->verification->is_email_verified && Auth::user()->verification->is_phone_verified){
            return true;
        }
    }

    protected function userBuyVerified(){
        if (Auth::user()->verification->is_email_verified && Auth::user()->verification->is_phone_verified && Auth::user()->verification->is_document_verified){
            return true;
        }
    }

    protected function sellerAccount(){
        if (Auth::user()->bankaccount){
            if (Auth::user()->bankaccount->bank_name && Auth::user()->bankaccount->account_name && Auth::user()->bankaccount->account_number){
                return true;
            }
        }
    }

    protected function buyerWallet($coin){
        if (Wallet::where('user_id', Auth::user()->id)->where('coin_id', $coin)->first()){
            return true;
        }
    }
}
