@extends('layouts.user')

@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">trades</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('success'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('success') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 mt-5">
                    <table id="example" class="table table-responsive-md text-left" width="100%">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Buyer/Seller</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($trades)  > 0)
                        @foreach($trades as $key=>$trade)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $trade->transaction_id }}</td>
                                <td>{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</td>
                                @if($trade->seller_id === Auth::user()->id)
                                    <td>Sell <i class="fas fa-arrow-circle-up text-danger"></i></td>
                                @elseif($trade->buyer_id === Auth::user()->id)
                                    <td>Buy <i class="fas fa-arrow-circle-down text-success"></i></td>
                                @endif
                                @if($trade->seller_id === Auth::user()->id)
                                    <td>{{ \App\User::find($trade->buyer_id)->display_name }}</td>
                                @elseif($trade->buyer_id === Auth::user()->id)
                                    <td>{{ \App\User::find($trade->seller_id)->display_name }}</td>
                                @endif
                                <td>{{ $trade->created_at->diffForHumans() }}</td>
                                @if($trade->transaction_status === "success")
                                    <td class="text-success font-weight-bold">{{ $trade->transaction_status }}</td>
                                @elseif($trade->transaction_status === "cancelled")
                                    <td class="text-danger font-weight-bold">{{ $trade->transaction_status }}</td>
                                @else
                                    <td class="text-warning font-weight-bold">{{ $trade->transaction_status }}</td>
                                @endif
                                <td>
                                    @if($trade->transaction_status === "pending")
                                        @if($trade->market->user_id === Auth::user()->id)
                                            @if(($trade->market->type === "buy" && $trade->buyer_transaction_stage === null) || ($trade->market->type === "sell" && $trade->seller_transaction_stage === null))
                                                @if($trade->seller_id === Auth::user()->id)
                                                    <a href="{{ route('trade.accept.sell', $trade) }}" class="btn btn-sm btn-success text-white">Accept</a>
                                                @elseif($trade->buyer_id === Auth::user()->id)
                                                    <a href="{{ route('trade.accept.buy', $trade) }}" class="btn btn-sm btn-success text-white">Accept</a>
                                                @endif
                                                <a href="#" class="btn btn-sm btn-danger text-white">Decline</a>
                                            @else
                                                @if($trade->seller_id === Auth::user()->id)
                                                    <a href="{{ route('trade.accept.sell', $trade) }}" class="btn btn-sm btn-success text-white">Continue</a>
                                                @elseif($trade->buyer_id === Auth::user()->id)
                                                    <a href="{{ route('trade.accept.buy', $trade) }}" class="btn btn-sm btn-success text-white">Continue</a>
                                                @endif
                                                <a href="#" class="btn btn-sm btn-danger text-white">Cancel</a>
                                            @endif
                                        @else
                                            @if($trade->seller_id === Auth::user()->id)
                                                <a href="{{ route('trade.initiate.sell', $trade->market->id) }}" class="btn btn-sm btn-success text-white">Continue</a>
                                            @elseif($trade->buyer_id === Auth::user()->id)
                                                <a href="{{ route('trade.initiate.buy', $trade->market->id) }}" class="btn btn-sm btn-success text-white">Continue</a>
                                            @endif
                                            <a href="#" class="btn btn-sm btn-danger text-white">Cancel</a>
                                        @endif
                                    @else
                                        <button class="btn btn-sm btn-success text-white" disabled>Continue</button>
                                        <button class="btn btn-sm btn-danger text-white" disabled>Cancel</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <td>
                                <div>You have made no trade</div>
                            </td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="mx-auto">
                    {{ $trades->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection
