<h4 class="text-center mb-4">Step 2</h4>
@if($trade->is_special == 1)
    @if($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null)
        <div class="text-center">
            <strong class="text-info" id="info-2-text" style="font-size: 23px">Waiting For Seller's Coin Verification </strong>
            <img width="50px" id="info-2-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-success" id="info-2-text" style="font-size: 23px">Seller's Coin Verified, Proceed with Trade </strong>
            <img width="100px" id="info-2-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
        </div>
    @endif
@else
    @if($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null)
        <div class="text-center">
            <strong class="text-info" id="info-2-text" style="font-size: 23px">Waiting For Seller to Accept Trade </strong>
            <img width="50px" id="info-2-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 1 && $trade->ace_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-info" id="info-2-text" style="font-size: 23px">Trade Acccepted, Waiting for Seller's Coin Processing </strong>
            <img width="50px" id="info-2-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-info" id="info-2-text" style="font-size: 23px">Trade Acccepted, Waiting for Seller's Coin Processing </strong>
            <img width="50px" id="info-2-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 2)
        <div class="text-center">
            <strong class="text-success" id="info-2-text" style="font-size: 23px">Coin Verified, Proceed with Transaction Below </strong>
            <img width="100px" id="info-2-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
        </div>
    @endif
@endif
<form class="row mb-4" action="post">
    <div class="form-group col-md-12">
        <label for="transactionID">Transaction ID</label>
                    <div class="d-flex ">
            <input type="text" name="transactionID" id="transactionID" value="{{ $trade->transaction_id }}" class="form-control col-sm-11 col-10" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a onclick="copyText('transactionID')" class="col-sm-1 m-0 col-2 btn text-white btn-secondary"><i class="fas fa-copy"></i></a>
        </div>
    </div>
    <div class="form-group col-md-6" >
        <label>Coin Volume</label>
        <input type="text" name="volume" value="{{ $trade->coin_amount }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
        <input type="number" name="amountNGN" value="{{ round($trade->coin_amount_ngn, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>A total of <strong>{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</strong> will be transferred to your <strong>{{ $trade->market->coin->abbr }}</strong> address below, please verify your wallet ID and cancel the transaction if there's any issue.</label>
        <input type="text" name="address" value="{{ \App\Wallet::where('user_id', Auth::user()->id)->where('coin_id', $trade->market->coin->id)->first()->address }}" class="form-control wallet-address" readonly>
    </div>
    <div class="mx-auto text-center mt-4" id="trade-cancel">
        <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn m-2 px-4 btn-danger">Cancel Trade</button>
        @if($trade->buyer_transaction_stage == 1)
            <button type="submit" id="step-2-proceed" class="btn btn-special m-2">Verify Wallet</button>
        @else
            <button type="submit" id="step-3-nav" class="btn btn-special m-2">Proceed</button>
        @endif
    </div>
</form>
