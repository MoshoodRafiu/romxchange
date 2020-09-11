<h4 class="text-center mb-4">Step 3</h4>
@if($trade->is_special == 1)
    @if($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-info" id="info-3-text" style="font-size: 23px">Waiting For Seller to Verify Payment </strong>
            <img width="50px" id="info-3-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 2)
        <div class="text-center">
            <strong class="text-success" id="info-3-text" style="font-size: 23px">Payment Verified, Proceed with Transaction</strong>
            <img width="100px" id="info-3-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
        </div>
    @endif
@else
    @if($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 2)
        <div class="text-center">
            <strong class="text-info" id="info-3-text" style="font-size: 23px">Waiting For Seller to Verify Payment </strong>
            <img width="50px" id="info-3-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 3)
        <div class="text-center">
            <strong class="text-success" id="info-3-text" style="font-size: 23px">Payment Verified, Proceed with Transaction</strong>
            <img width="100px" id="info-3-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
        </div>
    @endif
@endif
<form class="mb-4">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="transactionID">Transaction ID</label>
                        <div class="d-flex ">
                <input type="text" name="transactionID" id="transactionID" value="{{ $trade->transaction_id }}" class="form-control col-sm-11 col-10" readonly>
                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                <a onclick="copyText('transactionID')" class="col-sm-1 m-0 col-2 btn text-white btn-secondary"><i class="fas fa-copy"></i></a>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="volume">Coin Volume</label>
            <input type="text" name="volume" id="volume" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="charges">Amount in NGN</label>
            <div class="d-flex ">
                <input type="text" name="amountNGN" id="amountNGN" value="{{ round($trade->coin_amount_ngn, 2) }}" class="form-control col-10" readonly>
                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                <a onclick="copyText('amountNGN')" class="col-2 btn m-0 text-white btn-secondary"><i class="fas fa-copy mx-1"></i></a>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>You are required to transfer a total of <strong>NGN {{ number_format($trade->coin_amount_ngn, 2) }}</strong> to the account details below.</label>
                                    <input type="text" name="bankName" id="address" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->bank_name }}" class="form-control" readonly>
        </div>
        <div class="form-group col-md-12">
            <label>Account Name</label>
                                    <input type="text" name="accountName" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->account_name }}" class="form-control" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="address">Account Number</label>
            <div class="d-flex ">
                <input type="text" name="accountNumber" id="accountNumber" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->account_number }}" class="form-control col-sm-11 col-10" readonly>
                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                <a onclick="copyText('accountNumber')" class="col-sm-1 m-0 col-2 btn text-white btn-secondary"><i class="fas fa-copy"></i></a>
            </div>
        </div>
        <div class="mx-auto text-center">
            <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn m-2 px-4 btn-danger">Cancel Trade</button>
            @if($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 2)
                @if($trade->is_dispute == 1)
                    <button type="button" disabled class="btn btn-info m-2 p-2">Dispute Trade</button>
                @else
                    <a href="{{ route('trade.dispute', $trade) }}" class="btn m-2 btn-info">Dispute Trade</a>
                @endif
            @else
                <button type="button" disabled class="btn btn-info m-2">Dispute Trade</button>
            @endif
            @if($trade->buyer_transaction_stage == 2)
                <button type="submit" id="step-3-proceed" class="btn btn-special m-2 px-4">I Have Made Payment</button>
            @else
                <button type="submit" id="step-4-nav" class="btn btn-special m-2 px-4">Proceed</button>
            @endif
        </div>
    </div>
</form>
