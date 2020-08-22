<?php

namespace App\Http\Controllers;

use App\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function allVerifications(){
        $verifications = Verification::where('document_verification_status', 'pending')->paginate(10);
        return view('admin.verification.index', ['verifications' => $verifications, 'search' => false]);
    }

    public function showVerification(Verification $verification){
        return view('admin.verification.show', ['verification' => $verification]);
    }

    public function approveVerification(Verification $verification){
        $verification->document_verification_status = "approved";
        $verification->is_document_verified = 1;
        $verification->update();
        return back()->with('message', 'Verification for '.$verification->user->display_name.' approved successfully');
    }

    public function declineVerification(Verification $verification){
        $verification->document_verification_status = "declined";
        $verification->is_document_verified = 0;
        $verification->update();
        return back()->with('message', 'Verification for '.$verification->user->display_name.' declined successfully');
    }

    public function index()
    {
        return view('user.dashboard.verification.index');
    }

    public function phone(){
        return view('user.dashboard.verification.phone');
    }

    public function requestCode(Request $request){
        $this->validate($request, [
            'phone' => 'required'
        ]);

        $user = Auth::user();
        if (!$user->phone){
            $user->phone = $request->phone;
            $user->update();
        }

        if ($user->verification){
            if ($user->verification->is_phone_verified == 1){
                return back()->with('error', 'Phone is already verified');
            }
        }


        $response = Http::post('https://termii.com/api/sms/otp/send', [
            "api_key" => env('TERMI_KEY'),
            "message_type" => env('TERMI_MESSAGE_TYPE'),
            "to" => '234'.$request->phone,
            "from" => env('TERMII_FROM'),
            "channel" => env('TERMII_CHANNEL'),
            "pin_attempts" => env('TERMII_PIN_ATTEMPT'),
            "pin_time_to_live" => env('TERMII_PIN_TIME_TO_LIVE'),
            "pin_length" => env('TERMII_PIN_LENGTH'),
            "pin_placeholder" => "< 1234 >",
            "message_text" => "Your verification pin for AcexWorld is < 1234 >",
            "pin_type" => env('TERMII_PIN_TYPE'),
        ])->json();

        if (!array_key_exists("pinId", $response)){
            return back()->with('error', 'Error sending OTP, please contact administrator');
        }

        $id = $response["pinId"];

        session()->put('id', $id);

        return back()->with('info', 'Verification OTP has been sent to your phone '.$request->phone.' enter the code below and click verify');
    }

    public function verifyCode(Request $request){
        $this->validate($request, [
            "code" => "required|numeric",
            "id" => "required",
        ]);

        $user = Auth::user();
        if ($user->verification){
            if ($user->verification->is_phone_verified == 1){
                return back()->with('error', 'Phone is already verified');
            }
        }

        $pin = $request->code;
        $pin_id = $request->id;

        $response = Http::post('https://termii.com/api/sms/otp/verify', [
            "api_key" => env('TERMI_KEY'),
            "pin_id" => $pin_id,
            "pin" => $pin,
        ])->json();

        if (array_key_exists("verified", $response)){
            if ($response['verified'] === true){
                $user = Auth::user();
                if ($user->verification){
                    $user->verification->is_phone_verified = 1;
                    $user->verification->update();
                }else{
                    $verification = new Verification;
                    $verification->user_id = $user->id;
                    $verification->is_phone_verified = 1;
                    $verification->save();
                }
                return back()->with('pin-success', 'Phone number verified');
            }elseif ($response['verified'] === "Expired"){
                return back()->with('pin-error', 'Pin Expired');
            }
        }

        if (array_key_exists("attemptsRemaining", $response)){
            return back()->with('pin-error', 'Incorrect OTP, '.$response['attemptsRemaining'].' attempts remaining');
        }
        return back()->with('pin-error', 'Error verifying phone');
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
