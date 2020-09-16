@extends('layouts.user')

@section('content')

    <section class="text-left bg-light" id="portfolio">
        <div class="col-md-10 mx-auto">
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
                            <div class="alert col-12 alert-warning text-left" role="alert">You have to verify your account before making a trade</div>
                        @endif
                    @endif
                @endif
            </div>
            <div class="filter col-md-12 mx-auto">
                <form class="row" method="get" action="{{ route('market.filter') }}">
                    <select class="form-control col-6 my-2 mx-auto" required name="type" style="margin: 0px">
                        <option value="">Select Market</option>
                        <option value="buy">I want to buy</option>
                        <option value="sell">I want to sell</option>
                    </select>
                    <select class="form-control col-6 my-2 mx-auto text-capitalize" required name="coin" style="margin: 0px">
                        <option value="">Select Coin</option>
                        @foreach(\App\Coin::all() as $coin)
                            <option class="text-capitalize" value="{{ $coin->id }}">{{ $coin->name }}</option>
                        @endforeach
                    </select>
                    @error('volume')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                    <input type="text" class="form-control col-12 my-2 mx-auto @error('volume') is-invalid @enderror" name="volume" value="{{ old('volume') }}" style="margin: 0px; height: 50px" placeholder="Coin Quantity">
                    <div class="text-right ml-auto">
                        <button type="submit" class="btn mt-1 mx-0 mb-4 btn-special">Filter Market</button>
                    </div>
                </form>
            </div>
            @if(count($markets) > 0)
                <table class="table bg-white shadow d-none d-md-table">
                    @foreach($markets as $market)
                        <tr>
                            <td class="p-4"><div><p>{{ $market->user->display_name }}</p></div></td>
                            <td class="p-4">
                                @if($market->type === "buy")
                                    <div class="font-weight-bold">Buyer<i class="fa fa-arrow-circle-down text-success mx-1"></i></div>
                                @elseif($market->type === "sell")
                                    <div class="font-weight-bold">Seller<i class="fa fa-arrow-circle-up text-danger mx-1"></i></div>
                                @endif
                            </td>
                            <td class="p-4">
                                <div><img src="{{ asset('/images/'.$market->coin->logo) }}" height="25px" class="mr-1" alt="logo"> {{ $market->min }}  -  {{ $market->max }} <span class="text-uppercase">{{ $market->coin->abbr }}</span></div>
                            </td>
                            <td class="p-4">
                                <div>{{ $market->rate }} / USD</div>
                            </td>
                            <td class="p-4">
                                <div>
                                    <i class="fa fa-star rating @if($market->rating() >= 1) text-warning @else text-secondary @endif"></i>
                                    <i class="fa fa-star rating @if($market->rating() >= 2) text-warning @else text-secondary @endif"></i>
                                    <i class="fa fa-star rating @if($market->rating() >= 3) text-warning @else text-secondary @endif"></i>
                                    <i class="fa fa-star rating @if($market->rating() >= 4) text-warning @else text-secondary @endif"></i>
                                    <i class="fa fa-star rating @if($market->rating() >= 5) text-warning @else text-secondary @endif"></i>
                                </div>
                            </td>
                            <td class="p-4">
                                @if($market->type === "buy")
                                    <a href="{{ route('trade.initiate.sell', $market) }}" class="d-none d-md-block btn btn-danger">Sell</a>
                                @elseif($market->type === "sell")
                                    <a href="{{ route('trade.initiate.buy', $market) }}" class="d-none d-md-block btn btn-success">Buy</a>
                                @endif
                            </td>
                        </tr>
                        <div class="col-sm-12 mx-auto bg-white d-block d-md-none d-flex justify-content-between shadow py-md-4 border-left border-warning my-2">
                            <div class="d-md-flex justify-content-around small">
                                <div><p>{{ $market->user->display_name }}</p></div>
                                @if($market->type === "buy")
                                    <div class="font-weight-bold">Buyer<i class="fa fa-arrow-circle-down text-success mx-1"></i></div>
                                @elseif($market->type === "sell")
                                    <div class="font-weight-bold">Seller<i class="fa fa-arrow-circle-up text-danger mx-1"></i></div>
                                @endif
                                <div><img src="{{ asset('/images/'.$market->coin->logo) }}" class="mr-1" height="20px" alt="logo"> {{ $market->min }}  -  {{ $market->max }} <span class="text-uppercase">{{ $market->coin->abbr }}</span></div>
                                <div>{{ $market->rate }} / USD</div>
                                <div>
                                    <i class="fa fa-star rating @if($market->rating() >= 1) text-warning @else text-secondary @endif"></i>
                                    <i class="fa fa-star rating @if($market->rating() >= 2) text-warning @else text-secondary @endif"></i>
                                    <i class="fa fa-star rating @if($market->rating() >= 3) text-warning @else text-secondary @endif"></i>
                                    <i class="fa fa-star rating @if($market->rating() >= 4) text-warning @else text-secondary @endif"></i>
                                    <i class="fa fa-star rating @if($market->rating() >= 5) text-warning @else text-secondary @endif"></i>
                                </div>
                            </div>
                            <div class="d-md-none d-block align-self-center">
                                @if($market->type === "buy")
                                    <a href="{{ route('trade.initiate.sell', $market) }}" class="btn btn-sm btn-danger">Sell</a>
                                @elseif($market->type === "sell")
                                    <a href="{{ route('trade.initiate.buy', $market) }}" class="btn btn-sm btn-success">Buy</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </table>
            @else
                <div class="col-12 p-5 col-sm-12 mx-auto bg-white d-md-block d-flex justify-content-between shadow py-md-4 border-left border-warning my-2">
                    No Market Available
                </div>
            @endif
            <div class="row">
                <div class="my-2 mx-auto text-center">
                    {{ $markets->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection
