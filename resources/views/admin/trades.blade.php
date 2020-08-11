@extends('layouts.admin')

@section('content')


    <h3 class="text-dark mb-4">Transactions</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">Transactions</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9 align-self-center">
                    @if(count($trades) > 0)
                        @if($search)
                            <h5 class="font-italic">Showing search result for <span class="font-weight-bold">'{{ $val }}'</span></h5>
                        @endif
                    @endif
                </div>
                <div class="col-md-3 ml-auto">
                    <form action="{{ route('admin.transactions.filter') }}" method="get" class="d-flex mt-2 mb-4">
                        <input type="text" name="val" class="form-control form-control-sm" placeholder="Search">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-responsive-lg my-0">
                    <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Buyer</th>
                        <th>Seller</th>
                        <th>Coin</th>
                        <th>Volume</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($trades) > 0)
                            @foreach($trades as $trade)
                                <tr>
                                    <td>{{ $trade->transaction_id }}</td>
                                    <td>{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}</td>
                                    <td>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}</td>
                                    <td class="text-uppercase">{{ $trade->market->coin->abbr }}</td>
                                    <td>{{ $trade->coin_amount }}</td>
                                    <td>{{ $trade->created_at->diffForHumans() }}</td>
                                    @if($trade->transaction_status === "pending")
                                        <td class="text-warning font-weight-bold">{{ $trade->transaction_status }}</td>
                                    @elseif($trade->transaction_status === "success")
                                        <td class="text-success font-weight-bold">{{ $trade->transaction_status }}</td>
                                    @elseif($trade->transaction_status === "cancelled")
                                        <td class="text-danger font-weight-bold">{{ $trade->transaction_status }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <td>
                                @if($search)
                                    <h5 class="font-italic">No search result for <span class="font-weight-bold">'{{ $val }}'</span></h5>
                                @else
                                    <h5 class="font-italic">No transaction(s) yet</h5>
                                @endif
                            </td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
