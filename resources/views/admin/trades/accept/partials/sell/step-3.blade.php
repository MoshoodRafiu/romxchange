<h4 class="text-center my-4">Step 3</h4>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Volume</label>
                       <input type="text" name="volume" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Transaction Charges</label>
        <input type="text" name="charges" value="{{ $trade->transaction_charge_coin }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>Coin Type</label>
        <input type="text" value="{{ $trade->coin->name }}" class="form-control text-capitalize" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>Wallet Company</label>
        <input type="text" value="{{ \App\Wallet::where('user_id', $trade->buyer_id)->where('coin_id', $trade->market->coin->id)->first()->company }}" class="form-control text-capitalize" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>Total Coin To Be Deposited</label>
        <div class="d-flex">
            <input type="text" name="coin-amount" id="coin-amount" value="{{ $trade->coin_amount + $trade->transaction_charge_coin }}" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn text-white btn-secondary" onclick="copyText('coin-amount')"><i class="fas fa-copy mx-1"></i></a>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label>You are required to deposit <strong>{{ $trade->coin_amount + $trade->transaction_charge_coin }} {{ $trade->market->coin->abbr }}</strong> to the {{ $trade->market->coin->abbr }} address below</label>
        <div class="d-flex">
            <input type="text" name="address" id="address" value="{{ \App\Wallet::where('user_id', $trade->buyer_id)->where('coin_id', $trade->market->coin->id)->first()->address }}" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn btn-secondary text-white" onclick="copyText('address')"><i class="fas fa-copy mx-1"></i></a>
        </div>
    </div>
    <div class="mx-auto">
        <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn px-4 btn-danger">Cancel Trade</button>
        @if($trade->buyer_transaction_stage == 3 || $trade->seller_transaction_stage == 2)
            @if($trade->is_dispute == 1)
                <button type="button" disabled class="btn btn-info p-2">Dispute Trade</button>
            @else
                <a href="{{ route('trade.dispute', $trade) }}" class="btn btn-info p-2">Dispute Trade</a>
            @endif
        @else
            <button type="button" disabled class="btn btn-info p-2">Dispute Trade</button>
        @endif
        @if($trade->seller_transaction_stage == 2)
            <button type="submit" id="step-3-proceed" class="btn btn-special mx-4">I Have Sent Coin</button>
        @else
            <button type="submit" id="step-4-nav" class="btn btn-special mx-4">Proceed</button>
        @endif
    </div>
</form>
