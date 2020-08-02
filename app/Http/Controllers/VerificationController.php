<?php

namespace App\Http\Controllers;

use App\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('user.dashboard.verification.index');
    }

    public function phone(){
        return view('user.dashboard.verification.phone');
    }

    public function document(){
        return view('user.dashboard.verification.document');
    }

    public function documentStore(Request $request){
        $this->validate($request, [
            'photo' => 'required|mimes:png,jpeg,jpg',
            'document' => 'required|mimes:png,jpeg,jpg'
        ]);

        if (Auth::user()->verification){
            if (Auth::user()->verification->document_verification_status === "pending"){
                return back()->with('error', 'Documents undergoing verification, please do not resend');
            }elseif (Auth::user()->verification->status === "approved"){
                return back()->with('error', 'Documents already verified');
            }
        }

        $photo = $request->file('photo');
        $document = $request->file('document');
        $photo_name = time().'-'.$photo->getClientOriginalName();
        $document_name = time().'-'.$document->getClientOriginalName();

        $destinationPath = public_path('/images');

        $photo->move($destinationPath, $photo_name);
        $document->move($destinationPath, $document_name);

        Auth::user()->verification()->create(['document_verification_status' => 'pending']);
        Auth::user()->documents()->create(['document_url' => $document_name, 'photo_url' => $photo_name]);

        return back()->with('message', 'Documents submitted successfully');
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
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function show(Verification $verification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function edit(Verification $verification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verification $verification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verification $verification)
    {
        //
    }
}
