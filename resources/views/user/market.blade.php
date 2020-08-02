@extends('layouts.user')

@section('content')

    <section class="text-left bg-light" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading" style="font-size: 28px;margin: 15px 0;">Market</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
                @if(Auth::user())
                    @if(!Auth::user()->verification)
                        <div class="alert col-12 alert-warning text-left" role="alert">You have to verify your account before making a trade</div>
                    @else()
                        @if(!Auth::user()->verification->is_email_verified || !Auth::user()->verification->is_phone_verified || !Auth::user()->verification->is_document_verified)
                            <div class="alert col-12 alert-warning text-left" role="alert">You have to verify your account before creating an advert</div>
                        @endif
                    @endif
                @endif
            </div>
            <div class="filter col-md-12 col-10 mx-auto">
                <form class="row" method="get" action="{{ route('market.filter') }}">
                    <select class="form-control col-6 my-2 mx-auto" required name="type" style="margin: 0px">
                        <option value="">Select Market Type</option>
                        <option value="buy">I want to buy</option>
                        <option value="sell">I want to sell</option>
                    </select>
                    <select class="form-control col-6 my-2 mx-auto text-capitalize" required name="coin" style="margin: 0px">
                        <option value="">Select Coin Type</option>
                        @foreach(\App\Coin::all() as $coin)
                            <option class="text-capitalize" value="{{ $coin->id }}">{{ $coin->name }}</option>
                        @endforeach
                    </select>
                    <input class="form-control col-12 my-2 mx-auto" name="volume" style="margin: 0px; height: 50px" placeholder="Coin Quantity">
                    <button type="submit" class="btn mt-2 mb-4 btn-special">Filter Market</button>
                </form>
            </div>
            @if(count($markets) > 0)
                @foreach($markets as $market)
                    <div class="col-10 col-sm-12 mx-auto bg-white d-md-block d-flex justify-content-between shadow py-md-4 border-left border-warning my-2">
                        <div class="d-md-flex justify-content-around">
                            <div><p>{{ $market->user->display_name }}</p></div>
                            @if($market->type === "buy")
                                <div class="font-weight-bold">Buyer<i class="fa fa-arrow-circle-down text-success mx-1"></i></div>
                            @elseif($market->type === "sell")
                                <div class="font-weight-bold">Seller<i class="fa fa-arrow-circle-up text-danger mx-1"></i></div>
                            @endif
                            <div><i class="fa fa-bitcoin text-warning"></i>{{ $market->min }}  -  {{ $market->max }} {{ $market->coin->name }}</div>
                            <div>NGN 4,745,345</div>
                            <div>
                                <i class="fa fa-star rating text-warning"></i>
                                <i class="fa fa-star rating text-warning"></i>
                                <i class="fa fa-star rating text-warning"></i>
                                <i class="fa fa-star rating text-warning"></i>
                                <i class="fa fa-star rating text-secondary"></i>
                            </div>
                            @if($market->type === "buy")
                                <a href="{{ route('trade.initiate.sell', $market) }}" class="d-none d-md-block btn btn-danger">Sell Now</a>
                            @elseif($market->type === "sell")
                                <a href="{{ route('trade.initiate.buy', $market) }}" class="d-none d-md-block btn btn-success">Buy Now</a>
                            @endif
                        </div>
                        <div class="d-md-none d-block align-self-center">
                            @if($market->type === "buy")
                                <a href="{{ route('trade.initiate.sell', $market) }}" class="btn btn-danger">Sell Now</a>
                            @elseif($market->type === "sell")
                                <a href="{{ route('trade.initiate.buy', $market) }}" class="btn btn-success">Buy Now</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-10 col-sm-12 mx-auto bg-white d-md-block d-flex justify-content-between shadow py-md-4 border-left border-warning my-2">
                    No Market Available
                </div>
            @endif
            <div class="my-2 mx-auto text-center">
                {{ $markets->appends(Request::except('page'))->links() }}
            </div>
        </div>
    </section>

@endsection
