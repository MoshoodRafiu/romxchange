@extends('layouts.user')

@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">verification</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6 mt-5">
                    <div id="card-devices" class="card-devices shadow zoom">
                        <div id="card-body" class="card-body">
                            <div class="d-flex justify-content-between text-left align-items-center">
                                <div id="card-title" class="card-title">
                                    <h5 class=""><i class="fa fa-envelope text-warning mx-1"></i>Email Verification<br /></h5>
                                    <div id="sub-title" class="sub-title">
                                        <h6 class="card-subtitle my-2">{{ substr(Auth::user()->email, 0, 20)."..." }}<br /></h6>
                                    </div>
                                    <div class="mt-3">
                                        @if(Auth::user()->verification)
                                            @if(Auth::user()->verification->is_email_verified)
                                                <h6 id="card-text" class="small">Verified: {{ Auth::user()->verification->email_verified_at }}<br /></h6>
                                                <button class="btn btn-warning px-4" disabled>Verified</button>
                                            @else
                                                <h6 id="card-text" class="small">Not Verified<br /></h6>
                                                <a href="#" class="btn btn-warning px-4">Verify Now</a>
                                            @endif
                                        @else
                                            <h6 id="card-text" class="small">Not Verified<br /></h6>
                                            <a href="#" class="btn btn-warning px-4">Verify Now</a>
                                        @endif
                                    </div>
                                </div>
                                @if(Auth::user()->verification)
                                    @if(Auth::user()->verification->is_email_verified)
                                        <div><i class="fa fa-check-circle text-warning fa-4x"></i></div>
                                    @else
                                        <div><i class="fa fa-info-circle text-warning fa-4x"></i></div>
                                    @endif
                                @else
                                    <div><i class="fa fa-info-circle text-warning fa-4x"></i></div>
                                @endif
                            </div>
                        </div>
                        <div id="border-bottom" class="border-bottom"></div>
                    </div>
                </div>
                <div class="col-md-6 mt-5">
                    <div id="card-devices" class="card-devices shadow zoom">
                        <div id="card-body" class="card-body">
                            <div class="d-flex justify-content-between text-left align-items-center">
                                <div id="card-title" class="card-title">
                                    <h5 class=""><i class="fa fa-phone text-warning mx-1"></i>Phone Verification<br /></h5>
                                    <div id="sub-title" class="sub-title">
                                        <h6 class="card-subtitle my-2">{{ Auth::user()->phone }}<br /></h6>
                                    </div>
                                    <div class="mt-3">
                                        @if(Auth::user()->verification)
                                            @if(Auth::user()->verification->is_phone_verified)
                                                <h6 id="card-text" class="small">Verified: {{ Auth::user()->verification->phone_verified_at }}<br /></h6>
                                                <button class="btn btn-warning px-4" disabled>Verified</button>
                                            @else
                                                <h6 id="card-text" class="small">Not Verified<br /></h6>
                                                <a href="{{ route('verification.phone') }}" class="btn btn-warning px-4">Verify Now</a>
                                            @endif
                                        @else
                                            <h6 id="card-text" class="small">Not Verified<br /></h6>
                                            <a href="{{ route('verification.phone') }}" class="btn btn-warning px-4">Verify Now</a>
                                        @endif
                                    </div>
                                </div>
                                @if(Auth::user()->verification)
                                    @if(Auth::user()->verification->is_email_verified)
                                        <div><i class="fa fa-check-circle text-warning fa-4x"></i></div>
                                    @else
                                        <div><i class="fa fa-info-circle text-warning fa-4x"></i></div>
                                    @endif
                                @else
                                    <div><i class="fa fa-info-circle text-warning fa-4x"></i></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-5">
                    <div id="card-devices" class="card-devices shadow zoom">
                        <div id="card-body" class="card-body">
                            <div class="d-flex justify-content-between text-left align-items-center">
                                <div id="card-title" class="card-title">
                                    <h5 class=""><i class="fa fa-file-text-o text-warning mx-1"></i>Documents Verification<br /></h5>
                                    <div id="sub-title" class="sub-title">
                                        <h6 class="card-subtitle my-2"><br /></h6>
                                    </div>
                                    <div class="mt-3">
                                        @if(Auth::user()->verification)
                                            @if(Auth::user()->verification->is_document_verified)
                                                <h6 id="card-text" class="small">Verified: {{ Auth::user()->verification->document_verified_at }}<br /></h6>
                                                <button class="btn btn-warning px-4" disabled>Verified</button>
                                            @else
                                                <h6 id="card-text" class="small">Not Verified<br /></h6>
                                                <a href="{{ route('verification.document') }}" class="btn btn-warning px-4">Verify Now</a>
                                            @endif
                                        @else
                                            <h6 id="card-text" class="small">Not Verified<br /></h6>
                                            <a href="{{ route('verification.document') }}" class="btn btn-warning px-4">Verify Now</a>
                                        @endif
                                    </div>
                                </div>
                                @if(Auth::user()->verification)
                                    @if(Auth::user()->verification->is_email_verified)
                                        <div><i class="fa fa-check-circle text-warning fa-4x"></i></div>
                                    @else
                                        <div><i class="fa fa-info-circle text-warning fa-4x"></i></div>
                                    @endif
                                @else
                                    <div><i class="fa fa-info-circle text-warning fa-4x"></i></div>
                                @endif
                            </div>
                        </div>
                        <div id="border-bottom" class="border-bottom"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
