<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Market;
use App\Trade;
use App\User;
use App\Verification;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Throwable;

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
        SEOMeta::setTitle('Home');
        SEOMeta::setDescription('This is my page description');
        SEOMeta::setCanonical('https://codecasts.com.br/lesson');

        $key = env('NOMICS_KEY');
        $markets = Market::orderBy('is_special', 'desc')->withCount(['reviews as star_rating' => function($query) {
            $query->select(DB::raw('coalesce(avg(star),0)'));
        }])->orderByDesc('star_rating')->limit(8)->get();

        try {
            $response = Http::get('https://api.nomics.com/v1/currencies/ticker?key='.$key.'&ids=BTC,ETH,XRP,BCH,LTC,TRX,YFI,USDT')->json();
            return view('user.index', compact('markets', 'response'));
        } catch (Throwable $e) {
            return view('user.index', compact('markets'));
        }
    }

    public function adminDashboard(){
        $trades = Trade::all();
        $coins = Coin::all();
        return view('admin.index', compact('trades', 'coins'));
    }

    public function verifyEmail(){
        if (Auth::user()->verification){
            if (Auth::user()->verification->is_email_verified == 1){
                return redirect()->route('home');
            }
        }
        return view('auth.verify');
    }

    public function verifyUser(Request $request){
        $verification_code = $request->code;
        $user = User::where('verification_code', $verification_code)->first();
        if ($user != null){
            $verification = new Verification();
            $verification->user_id = $user->id;
            $verification->is_email_verified = 1;
            $verification->email_verified_at = now();
            $verification->save();

            return redirect()->route('login')->with('message', 'Account verified, please login below');
        }
        return redirect()->route('login')->with('error', 'Error!!! Something went wrong, account not verified');
    }

    public function resendEmail(){
        $user = Auth::user();
        $user->verification_code = sha1($user->email.time());
        $user->update();

        if ($user != null){
//            Send Email
            MailController::sendSignupEmail($user->display_name, $user->email, $user->verification_code);
        }
        return back()->with('resent', 'A fresh verification link has been sent to your email address.');
    }


}
