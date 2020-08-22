<div class="text-center my-3">
    <img width="120px" src="{{ asset('assets/img/success.gif') }}" alt="success">
</div>
<p class="text-center">Transaction completed <strong class="text-success">{{ $trade->coin_amount }} <span class="text-uppercase">{{ $trade->coin->abbr }}</span></strong> has been traded between <strong>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}</strong> and <strong>{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}</strong>. The transaction charges was <strong>{{ $trade->transaction_charge_coin }} {{ $trade->coin->abbr }}</strong> and <strong>NGN {{ number_format($trade->transaction_charge_ngn) }}</strong></p>
<div class="text-center">
    <a class="btn btn-special p-2" href="{{ route('admin.transactions.enscrow') }}">Finish Transaction</a>
</div>
