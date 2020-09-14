@extends('layouts.admin')

@section('content')
    <h3 class="text-dark mb-4">Profile</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3">
                    <p class="text-primary m-0 font-weight-bold">Personal Information</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Display Name</label>
                                <input type="text" class="form-control" name="display_name" value="{{ Auth::user()->display_name }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Phone <strong class="text-info">(phone number should be in format 2348090000000)</strong></label>
                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between py-3">
                    <p class="text-primary m-0 font-weight-bold">Password</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.password.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Old Password</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password">
                                @error('old_password')
                                    <div><strong class="text-danger">{{ $message }}</strong></div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')
                                <div><strong class="text-danger">{{ $message }}</strong></div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div>
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
