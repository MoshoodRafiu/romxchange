<?php

namespace App\Http\Controllers;

use App\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.dashboard.profile');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $account = BankAccount::where('user_id', $user->id)->first();

        if ($request->old_password || $request->password){
            $this->validate($request, [
                "old_password" => "required",
                "password" => "required|required_with:confirm_password |min:8|max:255"
            ]);

            if (Hash::check($request->old_password, $user->password)){
                $user->password = bcrypt($request->password);
            }else{
                return back()->with('error', 'Invalid Old Password Provided');
            }
        }
        if (!$account){
            BankAccount::create(
                [
                    "user_id" => $user->id,
                    "account_name" => $request->account_name,
                    "account_number" => $request->account_number,
                    "bank_name" => $request->bank_name
                ]
            );
        }else{
            $account->update([
                "account_name" => $request->account_name,
                "account_number" => $request->account_number,
                "bank_name" => $request->bank_name
            ]);
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->update();

        return back()->with('message', 'Profile Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
