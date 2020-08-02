@extends('layouts.user')

@section('content')

    <section class="text-right bg-light" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 alert-col">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">profile</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('put')
                <div class="form-row profile-row my-2">
                    <div class="col-md-4">
                        <h6 class="text-center mt-5">BANK DETAILS</h6>
                        <hr />
                        <div class="form-group text-left">
                            <label class="text-center">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name" value="{{ Auth::user()->bankaccount ? Auth::user()->bankaccount->bank_name : "" }}"/>
                        </div>
                        <div class="form-group text-left">
                            <label class="text-center">Account Number</label>
                            <input type="number" class="form-control" name="account_number" value="{{ Auth::user()->bankaccount ? Auth::user()->bankaccount->account_number : "" }}"/>
                        </div>
                        <div class="form-group text-left">
                            <label class="text-center">Account Name</label>
                            <input type="text" class="form-control" name="account_name" value="{{ Auth::user()->bankaccount ? Auth::user()->bankaccount->account_name : "" }}" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-center mt-5">PERSONAL DETAILS</h6>
                        <hr />
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label class="text-justify">Firstname </label>
                                    <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }} "/>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label>Lastname </label>
                                    <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label class="text-justify">Display Name</label>
                                    <input type="text" class="form-control" name="display_name" disabled value="{{ Auth::user()->display_name }}"/>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label>Email </label>
                                    <input type="email" class="form-control" name="email" disabled value="{{ Auth::user()->email }}"/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <label>Phone</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ Auth::user()->phone }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-12">
                        <h6 class="text-center mt-5">CHANGE PASSWORD</h6>
                        <hr />
                        <div class="form-group text-left">
                            <label>Old Password </label>
                            @error('old_password')
                                <div>
                                    <span class="text-danger small" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" autocomplete="off" name="old_password" />
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label>New Password </label>
                                    @error('password')
                                        <div>
                                            <span class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </div>
                                    @enderror
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label>Confirm New Password</label>
                                    @error('password')
                                        <div>
                                            <span class="text-danger small" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </div>
                                    @enderror
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="confirm_password" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mt-3 mb-5 content-right"><button class="btn btn-special form-btn" type="submit">UPDATE PROFILE </button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
