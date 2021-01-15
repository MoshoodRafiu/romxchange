@extends('layouts.user')

@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">wallets</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="ml-auto">
                    <a href="{{ route('wallet.create') }}" class="btn btn-special d-flex align-items-center align-self-center">Add Wallet<i class="fa mx-1 fa-plus-circle"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-responsive-sm text-left" width="100%">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Currency</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($wallets) > 0)
                            @foreach($wallets as $key=>$wallet)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $wallet->address }}</td>
                                    <td>{{ $wallet->company }}</td>
                                    <td class="text-capitalize">{{ $wallet->coin->name }}</td>
                                    <td>
                                        <a href="{{ route('wallet.edit', $wallet) }}" class="btn btn-warning"><i class="fas fa-pencil-alt d-xl-flex justify-content-xl-center align-items-xl-center"></i></a>
                                        <button type="button" data-toggle="modal" data-target="#deleteModal{{ $wallet->id }}" class="btn btn-danger"><i class="far fa-trash-alt d-xl-flex justify-content-xl-center align-items-xl-center"></i></button>

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
                                                        Are you sure you want to delete this <strong class="text-capitalize">{{ $wallet->coin->name }}</strong> wallet details?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <form method="post" action="{{ route('wallet.destroy', $wallet) }}">
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
                            <td>You have no wallet</td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
