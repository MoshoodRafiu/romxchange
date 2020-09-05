@extends('layouts.user')

@section('content')

    <section class="text-right bg-light" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 alert-col">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">update advert</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <form method="post" action="{{ route('market.update', $market) }}">
                @method('PUT')
                @csrf
                <div class="form-row profile-row my-2">
                    <div class="col-md-12 mx-auto">
                        <h6 class="text-center mt-5">ADVERT DETAILS</h6>
                        <hr />
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label class="text-justify">Select Coin</label>
                                    <select name="coin" id="coin" class="form-control @error('coin') is-invalid @enderror text-capitalize" required disabled>
                                        <option value="">Select Coin</option>
                                        @foreach($coins as $coin)
                                            @if($coin->id === $market->coin_id)
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
                                    <label>Advert Type </label>
                                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required disabled>
                                        <option value="">Select Advert Type</option>
                                        @if($market->type === "buy")
                                            <option value="buy" class="text-success font-weight-bold" selected>I want to buy</option>
                                            <option value="sell" class="text-danger font-weight-bold">I want to sell</option>
                                        @elseif($market->type === "sell")
                                            <option value="buy" class="text-success font-weight-bold">I want to buy</option>
                                            <option value="sell" class="text-danger font-weight-bold" selected>I want to sell</option>
                                        @endif
                                    </select>
                                    @error('type')
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
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group text-left">
                                    <label>Minimum Trade</label>
                                    <input type="text" class="form-control @error('min') is-invalid @enderror" name="min" value="{{ $market->min }}" autocomplete="off" required />
                                    @error('min')
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
                                    <label>Maximun Trade</label>
                                    <input type="text" class="form-control @error('max') is-invalid @enderror" name="max" value="{{ $market->max }}" autocomplete="off" required />
                                    @error('max')
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
                                    <label>USD/NGN Rate</label>
                                    <input type="text" class="form-control @error('rate') is-invalid @enderror" placeholder="e.g 420" value="{{ $market->price_ngn }}" name="rate" autocomplete="off" required />
                                    @error('rate')
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
                            <div class="col-md-12 mt-3 mb-5 content-right"><button class="btn btn-special form-btn" type="submit">Update Advert </button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
