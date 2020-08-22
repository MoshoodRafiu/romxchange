<h4 class="text-center my-4">Settle Transaction</h4>
@if($trade->seller_transaction_stage == 3 && $trade->buyer_transaction_stage == 3 && $trade->ace_transaction_stage == 2)
    <div class="text-center" id="transaction-message">
        <strong class="text-success" style="font-size: 23px">Settle Buyer, and Finish Trade Below </strong>
        <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
    </div>
@endif
<form>
    <div class="d-md-flex justify-content-between">
        <h4 class="text-success">Transaction Success <i class="fa fa-check-circle"></i></h4>
        <h4 class="text-muted">Send coin to buyer <i class="fa fa-paper-plane"></i></h4>
    </div>
    <div class="form-row">
        <div class="col-12">
            <div class="form-group"><label><strong>Transaction ID</strong></label><input type="text" class="form-control" value="{{ $trade->transaction_id }}" disabled/></div>
        </div>
        <div class="col-12">
            <div class="form-group"><label><strong>Coin</strong></label><input type="text" class="form-control" value="{{ $trade->coin->name }}" disabled/></div>
        </div>
        <div class="col-md-6">
            <div class="form-group"><label><strong>Buyer</strong></label><input type="text" class="form-control" value="{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}" disabled/></div>
        </div>
        <div class="col-md-6">
            <div class="form-group"><label><strong>Seller</strong></label><input type="text" class="form-control" value="{{ \App\User::whereId($trade->seller_id)->first()->display_name }}" disabled/></div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name"><strong>Amount</strong><br /></label>
                <div class="row mx-auto">
                    <input type="text" class="form-control col-10" id="coin-amount" name="first_name" value="{{ $trade->coin_amount }}" readonly/>
                    <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                    <a class="col-2 btn text-white btn-secondary" onclick="copyText('coin-amount')"><i class="fa fa-copy"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group"><label><strong>Charges</strong><br /></label><input type="text" class="form-control" value="{{ $trade->transaction_charge_coin }} {{ $trade->coin->abbr }}" disabled/></div>
        </div>
        <div class="col-12">
            <div class="form-group"><label><strong>Wallet Company</strong></label><input type="text" class="form-control" value="{{ $trade->seller_wallet_company }}" disabled/></div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="username"><strong>Buyer Wallet Address</strong></label>
                <div class="row mx-auto">
                    <input type="text" class="form-control col-md-11 col-8" id="buyer-wallet" value="{{ \App\Wallet::where('user_id', $trade->buyer_id)->where('coin_id', $trade->coin->id)->first()->address }}" readonly/>
                    <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                    <a class="col-md-1 col-4 btn text-white btn-secondary" onclick="copyText('buyer-wallet')"><i class="fa fa-copy"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group text-center">
    @if($trade->buyer_transaction_stage >= 3 && $trade->buyer_transaction_stage >= 3 && $trade->ace_transaction_stage == 2)
        <button class="btn btn-special" id="step-2-proceed" type="submit">Transaction Has Been Settled</button>
    @else
        <button id="step-3-nav" class="btn btn-special py-2 px-4" type="button">Proceed</button>
    @endif
    </div>
</form>
