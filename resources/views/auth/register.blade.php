@extends('layouts.user')

@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h1 class="text-uppercase text-center section-heading" style="  font-size: 25px;">Register</h1>
                </div>
            </div>
            <div class="col-md-5 mx-auto text-left">
                <div class="mx-auto text-center">
                    <i class="fa fa-user-circle" style="font-size: 50px; color: #04122f;"></i>
                </div>
                @if(Session::has('message'))
                    <div class="alert col-12 w-100 my-3 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 w-100 my-3 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="text-special">Display Name</label>
                        @error('display_name')
                            <div>
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                        @enderror
                        <input id="name" type="text" class="form-control @error('display_name') is-invalid @enderror" name="display_name" value="{{ old('display_name') }}" required autocomplete="name" autofocus placeholder="Display Name" />
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-special">Email Address</label>
                        @error('email')
                            <div>
                                <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                        @enderror
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-special ">Password</label>
                        @error('password')
                            <div>
                                 <span class="text-danger small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                        @enderror
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="text-special ">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                    </div>
                    <div class="mx-auto text-center">
                        <div class="mt-2"><button class="btn btn-login btn-block w-100" type="submit">Register</button></div>
                    </div>
                </form>
                <p class="text-center mt-3 mb-0"><a class="text-special text-info small" href="{{ url('/login') }}">Already have an account? Login </a></p>
            </div>
        </div>
    </section>

@endsection
