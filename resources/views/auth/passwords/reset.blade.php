@extends('layouts.user')

@section('content')
<section class="text-right bg-light pb-5" id="profile">
    <div class="container profile profile-view" id="profile">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h1 class="text-uppercase text-center section-heading" style="  font-size: 25px;">Reset Password</h1>
            </div>
        </div>
        <div class="row">
        </div>
        <div class="col-md-5 mx-auto text-left">
            <div class="mx-auto text-center">
                <i class="fa fa-user-circle" style="font-size: 50px; color: #04122f;"></i>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label class="text-special" for="email">Email Address</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                </div>

                <div class="form-group">
                    <label class="text-special" for="password">Password</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label class="text-special" for="password-confirm">Confirm Password</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12 text-center mt-3 mb-0">
                        <button class="btn btn-login btn-block w-100" type="submit">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
