@extends('layouts.admin')

@section('content')

    <h3 class="text-dark mb-4">Trades</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">All pending trades</p>
        </div>
        <div class="card-body">
            @if(count($trades) > 0)
                @foreach($trades as $trade)
                    <div class="col-md-12 col-12 mx-auto bg-white d-md-block d-flex justify-content-between align-items-center shadow py-md-4 border-left border-dark my-2">
                        <div class="d-md-flex justify-content-between">
                            <div><p class="small my-1 font-weight-bold">Transaction ID</p><p class="my-0">{{ $trade->transaction_id }}</p></div>
                            <div><p class="small my-1 font-weight-bold">Coin Volume</p><p class="my-0">{{ $trade->coin_amount }} <strong class="text-uppercase">{{ $trade->coin->abbr }}</strong></p></div>
                            <div><p class="small my-1 font-weight-bold">Status</p><p class="my-0 text-warning font-weight-bold">{{ $trade->transaction_status }}</p></div>
                            @if($trade->buyer_transaction_stage == null)
                                <div class="d-md-block  my-2"><button type="button" class="btn btn-danger">Cancel</button></div>
                            @else
                                <div class="d-md-block  my-2"><button type="button" disabled class="btn btn-danger">Cancel</button></div>
                            @endif
                            @if($trade->market->type == "buy")
                                @if($trade->buyer_transaction_stage == null)
                                    <div class="d-md-block  my-2"><a href="{{ route('admin.trade.accept.buy', $trade) }}" class="btn btn-success">Accept</a></div>
                                @else
                                    <div class="d-md-block  my-2"><a href="{{ route('admin.trade.accept.buy', $trade) }}" class="btn btn-success">Continue</a></div>
                                @endif
                            @elseif($trade->market->type == "sell")
                                @if($trade->seller_transaction_stage == null)
                                    <div class="d-md-block  my-2"><a href="{{ route('admin.trade.accept.sell', $trade) }}" class="btn btn-success">Accept</a></div>
                                @else
                                    <div class="d-md-block  my-2"><a href="{{ route('admin.trade.accept.sell', $trade) }}" class="btn btn-success">Continue</a></div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <p class="my-4">No pending trade</p>
            @endif
        </div>
    </div>
@endsection
