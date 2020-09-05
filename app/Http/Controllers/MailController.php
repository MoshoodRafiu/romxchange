<?php

namespace App\Http\Controllers;

use App\Mail\AgentInvitationMail;
use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupEmail($display_name, $email, $verification_code){
        $data = [
            'display_name' => $display_name,
            'verification_code' => $verification_code,
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }

    public static function sendAgentInvitationEmail($display_name, $email, $password){
        $data = [
            'display_name' => $display_name,
            'email' => $email,
            'password' => $password,
        ];
        Mail::to($email)->send(new AgentInvitationMail($data));
    }
}
