@extends('layouts.user')


@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">phone verification</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 mx-auto my-5">
                    @if(Session::has('message'))
                        <div class="alert alert-success w-100 text-left col-12">{{ session('message') }}</div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger w-100 text-left col-12">{{ session('error') }}</div>
                    @endif
                    <div class="card shadow">
                        <div class="card-body text-left">
                            <p>Enter your phone number below, click on <strong>Send Code</strong> a verification code will be sent to you via SMS</p>
                            <form action="{{ route('verification.phone.code.request') }}" method="post" class="my-4">
                                @csrf
                                <div class="form-group">
                                    @if(Session::has('info'))
                                        <span class="text-info">{{ session('info') }}</span>
                                    @endif
                                    <div class="form-group col-md-12 p-0">
                                        @error('phone')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                        <label>Phone Number <span class="text-info font-weight-bold">(phone number should be in format 2348090000000)</span></label>
                                        <div class="d-flex justify-content-between">
                                            <input type="tel" name="phone" placeholder="2348090000000" class="form-control col-md-10 col-sm-8 col-6" value="{{ Auth::user()->phone }}"
                                                @if(Auth::user()->verification)
                                                    @if(Auth::user()->verification->is_phone_verified == 1)
                                                        disabled
                                                    @endif
                                                @endif>
                                            @if(Auth::user()->verification)
                                                @if(Auth::user()->verification->is_phone_verified == 1)
                                                    <button disabled class="btn btn-info col-md-2 col-sm-4 col-6" type="button">Send Code</button>
                                                @else
                                                    @if(Session::has('id'))
                                                        <button class="btn btn-info col-md-2 col-sm-4 col-6" type="button" disabled>Send Code</button>
                                                    @else
                                                        <button class="btn btn-info col-md-2 col-sm-4 col-6" type="submit">Send Code</button>
                                                    @endif
                                                @endif
                                            @else
                                                @if(Session::has('id'))
                                                    <button class="btn btn-info col-md-2 col-sm-4 col-6" type="button" disabled>Send Code</button>
                                                @else
                                                    <button class="btn btn-info col-md-2 col-sm-4 col-6" type="submit">Send Code</button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('verification.phone.code.verify') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="@if(Session::has('id')) {{ session('id') }} @endif">
                                <div class="form-group">
                                    @if(Session::has('pin-error'))
                                        <div class="text-danger">{{ session('pin-error') }}</div>
                                    @elseif(Session::has('pin-success'))
                                        <div class="text-success font-weight-bold">{{ session('pin-success') }}</div>
                                    @endif
                                    @error('code')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                    <label for="code">Enter Code</label>
                                    <input type="number" id="code" name="code" class="form-control"
                                        @if(Auth::user()->verification)
                                            @if(Auth::user()->verification->is_phone_verified == 1)
                                                disabled
                                            @endif
                                        @endif>
                                </div>
                                <div class="form-group text-center mt-3">
                                    @if(Auth::user()->verification)
                                        @if(Auth::user()->verification->is_phone_verified == 1)
                                            <button disabled type="button" class="btn btn-special">Verify Phone</button>
                                        @else
                                            <button type="submit" class="btn btn-special">Verify Phone</button>
                                        @endif
                                    @else
                                        <button type="submit" class="btn btn-special">Verify Phone</button>
                                    @endif
                                </div>
                            </form>
                            <div class="text-center"><span>Didn't get code? <a href="{{ route('verification.phone.code.resend') }}">click here</a></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
