<h4 class="text-center my-4">Step 1</h4>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Amount</label>
                                <input type="type" name="amount" value="" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in USD</label>
        <input type="text" name="amount-usd" value="" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
        <input type="text" name="amount-ngn" value="" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Transaction Charges</label>
                                <input type="number" name="charges" value="0.000056" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label></label>
        <select name="wallet" class="form-control" disabled>
            <option value="">Select Wallet You Are Sending From</option>
{{--            @foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $trade->market->coin_id)->get() as $wallet)--}}
{{--                <option value="{{ $wallet->company }}">{{ $wallet->company }}</option>--}}
{{--            @endforeach--}}
            <option value="others">Others</option>
        </select>
    </div>
    <div class="mx-auto">
        <button type="submit" id="step-1-disabled" class="btn btn-special px-5" disabled>Proceed</button>
    </div>
</form>
