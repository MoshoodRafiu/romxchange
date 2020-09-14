<h4 class="text-center my-4">Step 1</h4>
@if($trade->transaction_status == "cancelled")
    <div class="text-center">
        <strong class="text-danger" id="info-2-text" style="font-size: 23px">Trade Cancelled, Close Trade Window</strong>
        <img width="50px" id="info-2-img" src="{{ asset('assets/img/cancel.gif') }}" alt="proceed">
    </div>
@endif
<form class="row mb-4">
    <div class="form-group col-md-12">
        <label for="transactionID">Transaction ID</label>
                    <div class="d-flex ">
            <input type="text" name="transactionID" id="transactionID" value="{{ $trade->transaction_id }}" class="form-control col-sm-11 col-10" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a onclick="copyText('transactionID')" class="col-sm-1 m-0 col-2 btn text-white btn-secondary"><i class="fas fa-copy"></i></a>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>Coin Amount</label>
                        <input type="type" name="amount" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in USD</label>
        <input type="text" name="amount-usd" value="{{ round($trade->coin_amount_usd, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
        <input type="text" name="amount-ngn" value="{{ round($trade->coin_amount_ngn, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Transaction Charges</label>
        <input type="number" name="charges" value="{{ $trade->transaction_charge_coin }}" class="form-control" disabled>
    </div>
    <div class="mx-auto text-center" id="trade-cancel">
        @if($trade->transaction_status == "cancelled")
            <a href="{{ route('admin.trades') }}" class="btn btn-info">Close Trade Window</a>
        @else
            <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn my-1 px-4 btn-danger">Cancel Trade</button>
            <button type="submit" id="step-1-nav" class="btn my-1 btn-special px-5">Proceed</button>
        @endif
    </div>
</form>
