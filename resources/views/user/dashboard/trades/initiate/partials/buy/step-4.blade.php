<h4 class="text-center my-4">Step 4</h4>
<div class="col-12 text-center mb-3">
    <div><img src="{{ asset('assets/img/success.gif') }}" width="100px" alt="success"></div>
    <h4 class="text-success">Success</h4>
</div>
<p>Transaction completed, <strong class="text-info">0.00353 BTC</strong> has been <strong class="text-success">bougth</strong> from <strong>Meezy</strong> at the rate of <strong class="text-success">NGN 4,745,364.254</strong> per BTC. Your coin will be released once the seller acknowledges payment. Please note that this can take few minutes to reflect in your provided wallet.</p>
<div class="text-center">
    @if($trade->buyer_transaction_stage == 3)
        <button id="step-4-proceed" class="btn btn-special p-2" type="button">Rate and Finish Transaction</button>
    @else
        <button type="submit" id="step-4-nav" class="btn btn-special mx-4">Proceed</button>
    @endif
</div>
