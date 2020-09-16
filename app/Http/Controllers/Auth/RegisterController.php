<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Verification;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'display_name' => ['required', 'string', 'min:2', 'max:255', 'unique:users,display_name', Rule::notIn(['admin', 'support', 'agent', 'help'])],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ]);
    }

    public function showRegistrationForm()
    {
        SEOMeta::setTitle('Register');
        return view('auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = new User();
        $user->display_name = $request->display_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1($request->email.time());
        $user->save();

        if ($user != null){
//            Send Email
            MailController::sendSignupEmail($user->display_name, $user->email, $user->verification_code);
            return back()->with('message', 'Account has been created, Please check email for verification link');
        }

//        Show error message
        return back()->with('error', 'Error!!! Something went wrong');
    }
}
