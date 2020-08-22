@extends('layouts.admin')

@section('content')

    <h3 class="text-dark mb-4">Register Agent</h3>

    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Agent Registration Form</p>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.agents.store') }}">
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>First Name</strong></label>
                            <input type="text" class="form-control @error("first_name") is-invalid @enderror" placeholder="First Name" name="first_name" value="{{ old('first_name') }}"/>
                        </div>
                        @error("first_name")
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Last Name</strong></label>
                            <input type="text" class="form-control @error("last_name") is-invalid @enderror" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}"/>
                        </div>
                        @error("last_name")
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Display Name</strong></label>
                            <input type="text" class="form-control @error("display_name") is-invalid @enderror" placeholder="Display Name" name="display_name" value="{{ old('display_name') }}"/>
                        </div>
                        @error("display_name")
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Email</strong></label>
                            <input type="email" class="form-control @error("email") is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}"/>
                        </div>
                        @error("email")
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Password</strong></label>
                            <input type="password" class="form-control @error("password") is-invalid @enderror" placeholder="Password" name="password"/>
                        </div>
                        @error("password")
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Confirm Password</strong></label>
                            <input type="password" class="form-control @error("confirm_password") is-invalid @enderror" placeholder="Confirm Password" name="confirm_password"/>
                        </div>
                        @error("confirm_password")
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-primary" type="submit">Register Agent</button>
                </div>
            </form>
        </div>
    </div>

@endsection
