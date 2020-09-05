@extends('layouts.admin')

@section('content')


    <h3 class="text-dark mb-4">{{ $user->display_name }}</h3>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">{{ $user->display_name }}'s Profile</p>
        </div>
        <div class="card-body">
            <table class="table table-borderless table-responsive-lg col-md-10">
                <tr>
                    <td><h5>Display Name:</h5></td>
                    <td><h5><span class="small">{{ $user->display_name }}</span></h5></td>
                </tr>
                <tr>
                    <td><h5>Full Name:</h5></td>
                    <td><h5><span class="small">@if ($user->last_name && $user->first_name){{ $user->last_name }} {{ $user->first_name }}@else <span class="font-italic">Not yet updated</span>@endif</span></h5></td>
                </tr>
                <tr>
                    <td><h5>Email:</h5></td>
                    <td><h5><span class="small">{{ $user->email }}</span></h5></td>
                </tr>
                <tr>
                    <td><h5>Phone:</h5></td>
                    <td><h5><span class="small">@if ($user->phone){{ $user->phone }}@else <span class="font-italic">Not yet updated</span>@endif</span></h5></td>
                </tr>
                <tr>
                    <td><h5>Completed Trades:</h5></td>
                    <td><h5><span class="small">{{ \App\Trade::where('transaction_status', 'success')->where(function ($query) use ($user) { $query->where('seller_id', $user->id)->orWhere('buyer_id', $user->id);})->count() }}</span></h5></td>
                </tr>
                @foreach(\App\Coin::all() as $coin)
                    <tr>
                        <td><h5>{{ $coin->abbr }} Traded:</h5></td>
                        <td><h5>
                                <span class="mr-5 small"><span class="text-danger mr-2 font-weight-bold">Sold <i class="fa fa-arrow-circle-up"></i></span>{{ $coin->trades()->where('seller_id', $user->id)->where('transaction_status', 'success')->sum('coin_amount') }}</span>
                                <span class="mr-5 small"><span class="text-success mr-2 font-weight-bold">Bought <i class="fa fa-arrow-circle-down"></i></span>{{ $coin->trades()->where('buyer_id', $user->id)->where('transaction_status', 'success')->sum('coin_amount') }}</span>
                            </h5>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td><h5>Verification:</h5></td>
                    <td>
                        <h5>
                            <span class="mr-5 small">Email @if($user->verification) <i class="fa fa-circle @if($user->verification->is_email_verified) text-success @else text-danger @endif"></i> @else <i class="fa fa-circle text-danger"></i> @endif</span>
                            <span class="mr-5 small">Phone @if($user->verification) <i class="fa fa-circle @if($user->verification->is_phone_verified) text-success @else text-danger @endif"></i> @else <i class="fa fa-circle text-danger"></i> @endif</span>
                            <span class="mr-5 small">Document @if($user->verification) <i class="fa fa-circle @if($user->verification->is_document_verified) text-success @elseif($user->verification->document_verification_status == "pending") text-warning  @else text-danger @endif"></i> @else <i class="fa fa-circle text-danger"></i> @endif</span>
                        </h5>
                    </td>
                </tr>
            </table>
            <div class="col-md-12">
                <h5>Document:</h5>
                <div>
                    @if($user->verification)
                        @if($user->verification->is_document_verified == 1)
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('/documents/'.$user->documents()->latest()->first()->photo_url) }}" alt="document" class="img img-fluid">
                                    <div class="text-center my-2">
                                        <a href="#" class="btn btn-special btn-sm"><i class="fa fa-save"></i> Save</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ asset('/documents/'.$user->documents()->latest()->first()->document_url) }}" alt="document" class="img img-fluid">
                                    <div class="text-center my-2">
                                        <a href="#" class="btn btn-special btn-sm"><i class="fa fa-save"></i> Save</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center">Document Not Available</div>
                        @endif
                    @else
                        <div class="text-center">Document Not Available</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
