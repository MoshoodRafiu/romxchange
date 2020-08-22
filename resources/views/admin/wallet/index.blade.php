@extends('layouts.admin')

@section('content')
    <h3 class="text-dark mb-4">Wallets @isset($coin) for <span class="text-capitalize">{{ $coin->name }}</span> @endisset</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">Showing all wallets @isset($coin) for <span class="text-capitalize">{{ $coin->name }}</span> @endisset</p>
            @isset($coin)
                <a href="{{ route('admin.wallets.create', $coin->name) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add <span class="text-capitalize">{{ $coin->name }} Wallet </span></a>
            @endisset
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9 align-self-center">
                    @if(count($wallets) > 0)
                        @if($search)
                            <h5 class="font-italic">Showing search result for <span class="font-weight-bold">'{{ $val }}'</span></h5>
                        @endif
                    @endif
                </div>
                <div class="col-md-3 ml-auto">
                    <form action="{{ route('admin.wallets.filter') }}" method="get" class="d-flex mt-2 mb-4">
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
                        <th>Wallet ID</th>
                        <th>Wallet Type</th>
                        <th>Company</th>
                        <th>Added</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    @if(count($wallets) > 0)
                        @foreach($wallets as $key=>$wallet)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $wallet->address }}</td>
                                <td class="text-capitalize">{{ $wallet->coin->name }}</td>
                                <td class="text-capitalize">{{ $wallet->company }}</td>
                                <td>{{ $wallet->created_at->diffForHumans() }}</td>
                                <td class="text-center d-flex">
                                    <a class="btn btn-primary mx-1" href="{{ route('admin.wallets.edit', $wallet->id) }}"><i class="fa fa-edit"></i></a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal{{ $wallet->id }}" class="btn mx-1 btn-danger"><i class="fas fa-trash"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $wallet->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $wallet->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $wallet->id }}">Confirm</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this <span class="text-capitalize">{{ $wallet->coin->name }}</span> wallet?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <form method="post" action="{{ route('admin.wallets.destroy', $wallet->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-success">Delete Wallet</button>
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
                                <h5 class="font-italic">No Wallet(s)@isset($coin) for <span class="text-capitalize">{{ $coin->name }}</span> @endisset yet</h5>
                            @endif
                        </td>
                    @endif
                    </tbody>
                </table>
                <div class="col-md-8 ml-auto">
                    {{ $wallets->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
