@extends('layouts.user')

@section('content')

    <section class="text-right bg-light" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 alert-col">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">update wallet</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <form method="post" action="{{ route('wallet.update', $wallet) }}">
                @method('PUT')
                @csrf
                <div class="form-row profile-row my-2">
                    <div class="col-md-12 mx-auto">
                        <h6 class="text-center mt-5">WALLET DETAILS</h6>
                        <hr />
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label class="text-justify">Select Coin</label>
                                    <select name="coin" id="coin" class="form-control text-capitalize @error('coin') is-invalid @enderror" required disabled>
                                        <option value="">Select Coin</option>
                                        @foreach(\App\Coin::all() as $coin)
                                            @if($wallet->coin_id === $coin->id)
                                                <option class="text-capitalize" value="{{ $coin->id }}" selected>{{ $coin->name }}</option>
                                            @else
                                                <option class="text-capitalize" value="{{ $coin->id }}">{{ $coin->name }}</option>
                                            @endif
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
                                    <label>Wallet Company </label>
                                    <select name="company" id="company" class="form-control @error('company') is-invalid @enderror" required>
                                        <option value="">Select Wallet Company</option>
                                        @foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $wallet->coin->id)->get() as $new_wallet)
                                            <option value="{{ $new_wallet->company }}" @if($wallet->company === $new_wallet->company) selected @endif>{{ $new_wallet->company }}</option>
                                        @endforeach
                                        <option value="others" @if($wallet->company === "others") selected @endif>Others</option>
                                    </select>
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
                                    <input type="text" class="form-control @error('wallet_address') is-invalid @enderror" value="{{ $wallet->address }}" name="wallet_address" autocomplete="off" required />
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
                        <hr />
                        <div class="form-row">
                            <div class="col-md-12 mt-3 mb-5 content-right"><button class="btn btn-special form-btn" type="submit">Update Wallet </button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

