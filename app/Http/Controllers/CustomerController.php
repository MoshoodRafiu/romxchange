<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Trade;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $users = User::latest()->where('is_agent', 0)->where('is_admin', 0)->paginate(10);
        return view ('admin.customer.index', ['users' => $users, 'search' => false]);
    }

    public function filter(Request $request){
        $users = User::latest()->
                        where('is_agent', 0)->
                        where('is_admin', 0)->
                        where('display_name', 'like', '%'.$request->val.'%')->
                        orWhere('email', 'like', '%'.$request->val.'%')->
                        orWhere('first_name', 'like', '%'.$request->val.'%')->
                        orWhere('last_name', 'like', '%'.$request->val.'%')->
                            paginate(10);

        return view ('admin.customer.index', ['users' => $users, 'search' => true, 'val' => $request->val]);
    }

    public function restrict($id){

        $user = User::find($id);

        $user->is_active = 0;

        $user->save();

        MailController::sendRestrictionEmail($user->display_name, $user->email);

        return back()->with('message', 'Account restricted successfully');
    }

    public function approve($id){

        $user = User::find($id);

        $user->is_active = 1;

        $user->save();

        MailController::sendApprovalEmail($user->display_name, $user->email);

        return back()->with('message', 'Account approved successfully');
    }

    public function show($name){
        $user = User::where('display_name',$name)->first();

        return view('admin.customer.show', compact('user'));
    }
}
