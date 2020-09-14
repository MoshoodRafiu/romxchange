<div class="card shadow">
    <div class="card-header bg-special text-warning">
        <h6>Seller's Information</h6>
    </div>
    <div class="card-body small">
        <table id="example" class="table table-responsive-sm text-left col-md-10 mx-auto" width="100%">
            <tr>
                <th>Username<th>
                <td>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}<td>
            </tr>
            <tr>
                <th>Rate<th>
                <td>{{ number_format($trade->market->rate) }} / USD<td>
            </tr>
            <tr>
                <th>Successful Trades<th>
                <td>{{ \App\Trade::where('transaction_status', 'success')->where(function ($query) use ($trade) {$query->where('buyer_id', $trade->seller_id)->orWhere('seller_id', $trade->seller_id);})->count() }}<td>
            </tr>
            <tr>
                <th>Transaction Limit<th>
                <td class="d-flex text-white">
                    <span class="bg-info p-1 rounded-pill font-weight-bold small mx-2">{{ $trade->market->min }}</span>
                    <span class="text-dark"> - </span>
                    <span class="bg-info p-1 rounded-pill font-weight-bold small mx-2">{{ $trade->market->max }}</span>
                    <span class="text-dark text-capitalize">{{ $trade->market->coin->name }}</span>
                <td>
            </tr>
        </table>
    </div>
</div>
