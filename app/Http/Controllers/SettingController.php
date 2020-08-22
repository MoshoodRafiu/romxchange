<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\Coin;
use App\Setting;
use App\User;
use App\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(){
        $coins = Coin::all();
        $setting = Setting::all()->first();
        return view('admin.settings', ['coins' => $coins, 'setting' => $setting]);
    }

    public function update(Request $request){
        $this->validate($request, [
            'charges' => 'required|numeric',
            'transaction_duration' => 'required|numeric'
        ]);

        if (Setting::all()->count() > 0){
            $setting = Setting::all()->first();
            $setting->charges = $request->charges;
            $setting->duration = $request->transaction_duration;
            $setting->update();
        }else {
            $setting = new Setting;
            $setting->charges = $request->charges;
            $setting->duration = $request->transaction_duration;
            $setting->save();
        }

        return back()->with('message', 'Setting updated successfully');
    }
    public function updateBank(Request $request){
        $this->validate($request, [
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required|min:10|max:10'
        ]);

        if (BankAccount::where('is_special', 1)->count() > 0){
            $bankaccount = BankAccount::where('is_special', 1)->first();
            $bankaccount->bank_name = $request->bank_name;
            $bankaccount->account_name = $request->account_name;
            $bankaccount->account_number = $request->account_number;

            $bankaccount->update();
        }else{
            $bankaccount = new BankAccount;
            $bankaccount->user_id = Auth::user()->id;
            $bankaccount->is_special = 1;
            $bankaccount->bank_name = $request->bank_name;
            $bankaccount->account_name = $request->account_name;
            $bankaccount->account_number = $request->account_number;

            $bankaccount->save();
        }
        return back()->with('message', 'Bank details updated successfully');
    }
}
