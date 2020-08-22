<div class="card shadow">
    <div class="card-header bg-special text-warning">
        <h6>Seller's Information</h6>
    </div>
    <div class="card-body">
        <table id="example" class="table table-responsive-sm text-left col-md-10 mx-auto" width="100%">
            <tr>
                <th>Username<th>
                <td>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}<td>
            </tr>
            <tr>
                <th>Rate USD<th>
                <td>USD {{ number_format($trade->market->price_usd) }}<td>
            </tr>
            <tr>
                <th>Rate NGN<th>
                <td>NGN {{ number_format($trade->market->price_ngn) }}<td>
            </tr>
            <tr>
                <th>Transaction Limit<th>
                <td class="d-flex text-white">
                    <p class="range bg-info p-1 rounded-pill font-weight-bold mx-2">{{ $trade->market->min }}</p>
                    <span class="text-dark"> - </span>
                    <p class="range bg-info p-1 rounded-pill font-weight-bold mx-2">{{ $trade->market->max }}</p>
                    <p class="text-dark text-capitalize">{{ $trade->market->coin->name }}</p>
                <td>
            </tr>
            <tr>
                <th>Last Seen<th>
                <td>Just Now<td>
            </tr>
        </table>
    </div>
</div>
