<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token){
        $data = [
            "email" => $this->email,
            "token" => $token
        ];

        Mail::send('mails.password', $data, function ($message) use ($data) {
            $message->to($data['email'])->subject('Reset Password Notification');
        });
    }

//    public function sendEmailVerificationNotification()
//    {
//        $this->notify(new App\Notifications\CustomVerifyEmail);
//    }

    public function markets(){
        return $this->hasMany('App\Market');
    }
    public function bankaccount(){
        return $this->hasOne('App\BankAccount');
    }
    public function wallets(){
        return $this->hasMany('App\Wallet');
    }
    public function verification(){
        return $this->hasOne('App\Verification');
    }
    public function documents(){
        return $this->hasMany('App\Document');
    }
    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }

}
