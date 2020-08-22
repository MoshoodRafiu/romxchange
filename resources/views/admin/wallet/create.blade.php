@extends('layouts.admin')

@section('content')

    <h3 class="text-dark mb-4">Add Wallet</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">Wallet Details</p>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.wallets.store') }}">
                @csrf
                <div class="form-row profile-row my-2">
                    <div class="col-md-12 mx-auto">
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label class="text-justify">Select Coin</label>
                                    <select name="coin" class="form-control @error('coin') is-invalid @enderror text-capitalize" onclick="event.preventDefault();" readonly="true">
                                        <option value="">Select Coin</option>
                                        @foreach(\App\Coin::all() as $main_coin)
                                            <option class="text-capitalize" value="{{ $main_coin->id }}" @if($main_coin->id == $coin->id) selected @endif>{{ $main_coin->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('coin')
                                    <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label>Wallet Company</label>
                                    <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" autocomplete="off"/>
                                    @error('company')
                                    <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12">
                                <div class="form-group text-left">
                                    <label>Wallet Address</label>
                                    <input type="text" class="form-control @error('wallet_address') is-invalid @enderror" name="wallet_address" value="{{ old('wallet_address') }}" autocomplete="off" />
                                    @error('wallet_address')
                                    <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-2 text-right">
                            <button class="btn btn-primary form-btn" type="submit">Add Wallet</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
