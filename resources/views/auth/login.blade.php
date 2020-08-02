@extends('layouts.user')

@section('content')
    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">login</h2>
                </div>
            </div>
            <div class="col-md-5 mx-auto text-left">
                <div class="mx-auto text-center">
                    <i class="fa fa-user-circle" style="font-size: 50px; color: #04122f;"></i>
                </div>
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label class="text-special" for="email">Email Address</label>
                        @error('email')
                            <div>
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                        @enderror
                        <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email"/>
                    </div>
                    <div class="form-group">
                        @error('password')
                            <div>
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                        @enderror
                        <label class="text-special" for="password">Password</label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password" />
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-special small" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                    <div class="mx-auto text-center">
                        <div class="mt-2"><button class="btn btn-login btn-block w-100" type="submit">Login</button></div>
                    </div>
                </form>
                <p class="text-center mt-3 mb-0"><a class="text-special text-info small" href="{{ url('/register') }}">Do not have account? Register </a></p>
            </div>
        </div>
    </section>
@endsection
