<h4 class="text-center my-4">Step 2</h4>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Volume</label>
                               <input type="text" name="volume" value="" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
                               <input type="number" name="amountNGN" value="" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label for="address">A total of <strong></strong> will be transferred to your <strong>BTC</strong> address below, please verify your wallet ID and cancel the transaction if there's any issue.</label>
                               <input type="text" name="address" id="address" value="gawtj632r6328kvchkffhwcv723rf" class="form-control wallet-address" readonly>
    </div>
    <div class="mx-auto">
        <button type="reset" id="step-2-cancel" class="btn btn-danger mx-4">Cancel Transaction</button>
        <button type="submit" id="step-2-proceed" class="btn btn-special mx-4">Proceed To Make Payment</button>
    </div>
</form>
