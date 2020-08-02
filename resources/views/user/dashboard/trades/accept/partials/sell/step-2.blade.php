<h4 class="text-center my-4">Step 2</h4>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Volume</label>
                       <input type="text" name="volume" value="" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Transaction Charges</label>
                        <input type="number" name="charges" value="0.00056" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>Total Coin To Be Deposited</label>
        <div class="d-flex">
            <input type="text" name="coin-amount" id="coin-amount" value="0.62476523" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn btn-secondary" onclick="copyText('coin-amount')"><i class="fas fa-copy mx-1"></i></a>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label>You are required to deposit <strong>0.0075245 BTC</strong> to the BTC address below</label>
        <div class="d-flex">
            <input type="text" name="address" id="address" value="gawtj632r6328kvchkffhwcv723rf" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn btn-secondary" onclick="copyText('address')"><i class="fas fa-copy mx-1"></i></a>
        </div>
    </div>
    <div class="mx-auto">
        <button type="reset" id="step-2-cancel" class="btn btn-danger mx-4">Cancel Transaction</button>
        <button type="submit" id="step-2-proceed" class="btn btn-special mx-4">I Have Deposited</button>
    </div>
</form>
