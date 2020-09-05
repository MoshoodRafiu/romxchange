<?php

namespace App\Http\Controllers;

use App\User;
use App\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $agents = User::where('is_agent', 1)->paginate(10);

        return view('admin.agent.index', ['agents' => $agents, 'search' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'display_name' => 'required|unique:users',
            'email' => 'required|unique:users',
        ]);

        $password = Str::random(10);

        $user = new User;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->display_name = $request->display_name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->is_agent = 1;
        $user->verification_code = sha1($request->email.time());

        $user->save();

        $verification = new Verification();
        $verification->user_id = $user->id;
        $verification->is_email_verified = 1;
        $verification->email_verified_at = now();

        $verification->save();

        MailController::sendAgentInvitationEmail($user->display_name, $user->email, $password);

        return redirect()->route('admin.agents')->with('message', 'Agent registered successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
