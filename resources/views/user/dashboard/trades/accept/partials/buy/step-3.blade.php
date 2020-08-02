<h4 class="text-center my-4">Step 3</h4>
<form class="mb-4">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Coin Volume</label>
                                   <input type="text" name="volume" value="" class="form-control" disabled>
        </div>
        <div class="form-group col-md-6">
            <label>Amount in NGN</label>
            <div class="d-flex ">
                <input type="text" name="amountNGN" id="amountNGN" value="" class="form-control col-10" readonly>
                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                <a onclick="copyText('amountNGN')" class="col-2 btn btn-secondary"><i class="fa fa-copy"></i></a>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="address">You are required to transfer a total of <strong>NGN </strong> to the account details below.</label>
                                   <input type="text" name="Account Number" value="" class="form-control" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="address">Account Name</label>
                                   <input type="text" name="Account Number" value="" class="form-control" readonly>
        </div>
        <div class="form-group col-md-12">
            <label for="address">Account Number</label>
            <div class="d-flex ">
                <input type="text" name="accountNumber" id="accountNumber" value="" class="form-control col-sm-11 col-10" readonly>
                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                <a onclick="copyText('accountNumber')" class="col-sm-1 col-2 btn btn-secondary"><i class="fa fa-copy"></i></a>
            </div>
        </div>
        <div class="mx-auto">
            <button type="submit" id="step-3-proceed" class="btn btn-special px-4">I Have Made Payment</button>
        </div>
    </div>
</form>
