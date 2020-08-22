@extends('layouts.admin')

@section('content')


    <h3 class="text-dark mb-4">Settings</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3">
                            <p class="text-primary m-0 font-weight-bold">Transacting Coins</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-lg">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Coin</th>
                                        <th>Short Name</th>
                                        <th>Logo</th>
                                        <th>Registered</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tbody>
                                    @if(count($coins) > 0)
                                        @foreach($coins as $key=>$coin)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="text-capitalize">{{ $coin->name }}</td>
                                                <td class="text-uppercase">{{ $coin->abbr }}</td>
                                                <td>
                                                    <img src="{{ asset('images/'.$coin->logo) }}" alt="logo" width="25px">
                                                </td>
                                                <td>{{ $coin->created_at->diffForHumans() }}</td>
                                                <td class="text-center d-flex">
                                                    <button type="button" data-toggle="modal" data-target="#deleteModal{{ $coin->id }}" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $coin->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $coin->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel{{ $coin->id }}">Confirm</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete {{ $coin->name }}?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    <form method="post" action="{{ route('admin.coins.destroy', $coin) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-success">Remove Coin</button>
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
                                            <h5 class="font-italic">No Coin(s) yet</h5>
                                        </td>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <p class="text-primary m-0 font-weight-bold">Bank Account Settings</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.bank.update') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="@if(\App\BankAccount::where('is_special', 1)->first()){{ \App\BankAccount::where('is_special', 1)->first()->bank_name }}@endif" placeholder="e.g Access Bank"/>
                                    @error('bank_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Account Name</label>
                                    <input type="text" name="account_name" class="form-control @error('account_name') is-invalid @enderror" value="@if(\App\BankAccount::where('is_special', 1)->first()){{ \App\BankAccount::where('is_special', 1)->first()->account_name }}@endif" placeholder="e.g Jon Doe"/>
                                    @error('account_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" class="form-control @error('account_number') is-invalid @enderror" value="@if(\App\BankAccount::where('is_special', 1)->first()){{ \App\BankAccount::where('is_special', 1)->first()->account_number }}@endif" placeholder="e.g 0000000011"/>
                                    @error('account_number')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <p class="text-primary m-0 font-weight-bold">Add Coin</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.coins.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g Bitcoin"/>
                                    @error('name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Short Name</label>
                                    <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" value="{{ old('short_name') }}" placeholder="e.g BTC"/>
                                    @error('short_name')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" name="logo" class="form-control"/>
                                    @error('file')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <p class="text-primary m-0 font-weight-bold">Transaction Settings</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Transaction Charges(%)</label>
                                    <input type="text" name="charges" class="form-control @error('charges') is-invalid @enderror" value="@if($setting){{ $setting->charges }}@endif" placeholder="e.g 1"/>
                                    @error('charges')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Transaction Duration (minutes)</label>
                                    <input type="text" name="transaction_duration" class="form-control @error('short_name') is-invalid @enderror" value="@if($setting){{ $setting->duration }}@endif" placeholder="e.g 10"/>
                                    @error('transaction_duration')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
