@extends('layouts.admin')

@section('content')


    <h3 class="text-dark mb-4">Market</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">Market</p>
            <a class="btn btn-primary" href="{{ route('admin.markets.create') }}"><i class="fa fa-plus"></i> Create Market</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9 align-self-center">
                    @if(count($markets) > 0)
                        @if($search)
                            <h5 class="font-italic">Showing search result for <span class="font-weight-bold">'{{ $val }}'</span></h5>
                        @endif
                    @endif
                </div>
                <div class="col-md-3 ml-auto">
                    <form action="{{ route('admin.markets.filter') }}" method="get" class="d-flex mt-2 mb-4">
                        <input type="text" name="val" class="form-control form-control-sm" placeholder="Search">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-responsive-lg">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Coin</th>
                        <th>Volume(Min)</th>
                        <th>Volume(Max)</th>
                        <th>Price(NGN)</th>
                        <th>Date</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    @if(count($markets) > 0)
                    @foreach($markets as $key=>$market)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $market->user->display_name }}</td>
                            @if($market->type === "buy")
                                <td class="text-success text-capitalize">{{ $market->type }}<i class="fa fa-arrow-circle-down mx-1"></i></td>
                            @elseif($market->type === "sell")
                                <td class="text-danger text-capitalize">{{ $market->type }}<i class="fa fa-arrow-circle-up mx-1"></i></td>
                            @endif
                            <td>{{ $market->coin->abbr }}</td>
                            <td>{{ $market->min }}</td>
                            <td>{{ $market->max }}</td>
                            <td>{{ number_format($market->price_ngn) }}</td>
                            <td>{{ $market->created_at->diffForHumans() }}</td>
                            <td class="text-center d-flex">
                                @if($market->is_special == 1)
                                    <a class="btn btn-primary mx-1" href="{{ route('admin.markets.edit', $market) }}"><i class="fa fa-edit"></i></a>
                                @endif
                                <button type="button" data-toggle="modal" data-target="#deleteModal{{ $market->id }}" class="btn mx-1 btn-danger"><i class="fa fa-trash"></i></button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $market->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $market->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $market->id }}">Confirm</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this market?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <form method="post" action="{{ route('admin.markets.destroy', $market) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-success">Delete Market</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <td>
                            @if($search)
                                <h5 class="font-italic">No search result for <span class="font-weight-bold">'{{ $val }}'</span></h5>
                            @else
                                <h5 class="font-italic">No market(s) yet</h5>
                            @endif
                        </td>
                    @endif
                    </tbody>
                </table>
                <div class="col-md-8 ml-auto">
                    {{ $markets->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
