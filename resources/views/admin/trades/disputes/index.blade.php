@extends('layouts.admin')

@section('content')

    <h3 class="text-dark mb-4">Disputes</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">All dispute trades</p>
        </div>
        <div class="card-body">
            @if(count($trades) > 0)
                <table class="table bg-white shadow table-responsive-lg d-none d-md-table">
                    @foreach($trades as $trade)
                        <tr>
                            <td><div><p class="small my-1 font-weight-bold">Transaction ID</p><p class="my-0">{{ $trade->transaction_id }}</p></div></td>
                            <td><div><p class="small my-1 font-weight-bold">Coin Volume</p><p class="my-0">{{ $trade->coin_amount }} <strong class="text-uppercase">{{ $trade->coin->abbr }}</strong></p></div></td>
                            <td><div><p class="small my-1 font-weight-bold">Status</p><p class="my-0 text-warning font-weight-bold">{{ $trade->transaction_status }}</p></div></td>
                            <td>
                                @if(!$trade->agent_id == null)
                                    @if($trade->agent_id == Auth::user()->id)
                                        <div class="d-md-block  my-2"><a href="{{ route('admin.trades.dispute.join', $trade) }}" class="btn btn-info">Continue Chat</a></div>
                                    @else
                                        <div class="d-md-block  my-2"><button disabled type="button" class="btn btn-danger">Chat Closed</button></div>
                                    @endif
                                @else
                                    <div class="d-md-block  my-2"><a href="{{ route('admin.trades.dispute.join', $trade) }}" class="btn btn-info">Join Chat</a></div>
                                @endif
                            </td>
                        </tr>
                        <div class="col-12 col-sm-12 mx-auto bg-white d-block d-md-none d-flex justify-content-between shadow py-md-4 border-left border-warning my-2">
                            <div class=" small">
                                <div><p class="small my-1 font-weight-bold">Transaction ID</p><p class="my-0">{{ $trade->transaction_id }}</p></div>
                                <div><p class="small my-1 font-weight-bold">Coin Volume</p><p class="my-0">{{ $trade->coin_amount }} <strong class="text-uppercase">{{ $trade->coin->abbr }}</strong></p></div>
                                <div><p class="small my-1 font-weight-bold">Status</p><p class="my-0 text-warning font-weight-bold">{{ $trade->transaction_status }}</p></div>
                            </div>
                            <div class="d-md-none d-block align-self-center">
                                @if(!$trade->agent_id == null)
                                    @if($trade->agent_id == Auth::user()->id)
                                        <div class="d-md-block  my-2"><a href="{{ route('admin.trades.dispute.join', $trade) }}" class="btn btn-sm btn-info">Continue Chat</a></div>
                                    @else
                                        <div class="d-md-block  my-2"><button disabled type="button" class="btn btn-sm btn-danger">Chat Closed</button></div>
                                    @endif
                                @else
                                    <div class="d-md-block  my-2"><a href="{{ route('admin.trades.dispute.join', $trade) }}" class="btn btn-sm btn-info">Join Chat</a></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </table>
            @else
                <p class="my-4">No dispute trade</p>
            @endif
        </div>
    </div>
@endsection
