@extends('layouts.admin')

@section('content')


    <h3 class="text-dark mb-4">Customers</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">Customers</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9 align-self-center">
                    @if(count($users) > 0)
                        @if($search)
                            <h5 class="font-italic">Showing search result for <span class="font-weight-bold">'{{ $val }}'</span></h5>
                        @endif
                    @endif
                </div>
                <div class="col-md-3 ml-auto">
                    <form action="{{ route('admin.customers.filter') }}" method="get" class="d-flex mt-2 mb-4">
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Verification</th>
                        <th>Registered</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    @if(count($users) > 0)
                        @foreach($users as $key=>$user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->display_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->verification)
                                        <i class="fa fa-circle @if($user->verification->is_email_verified) text-success @else text-danger @endif icon"></i>
                                        <i class="fa fa-circle @if($user->verification->is_phone_verified) text-success @else text-danger @endif icon"></i>
                                        <i class="fa fa-circle @if($user->verification->is_document_verified) text-success @elseif($user->verification->document_verification_status == "pending") text-warning  @else text-danger @endif icon"></i>
                                    @else
                                        <i class="fa fa-circle text-danger icon"></i>
                                        <i class="fa fa-circle text-danger icon"></i>
                                        <i class="fa fa-circle text-danger icon"></i>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td class="text-center d-flex">
                                    <a class="btn btn-primary mx-1" href="{{ route('admin.customers.show', $user->display_name) }}"><i class="fa fa-eye"></i></a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal{{ $user->id }}" class="btn mx-1 @if($user->is_active) btn-danger @else btn-success @endif">@if($user->is_active) <i class="fas fa-user-alt-slash"></i> @else <i class="fas fa-user-check"></i> @endif</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirm</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to @if($user->is_active) <span class="font-italic">Restrict</span> @else <span class="font-italic">Approve</span> @endif this Customer?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <form method="get" action="@if($user->is_active) {{ route('admin.customers.restrict', $user) }} @else {{ route('admin.customers.approve', $user) }} @endif">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">@if($user->is_active) Restrict @else Approve @endif Customer</button>
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
                                <h5 class="font-italic">No Customer(s) yet</h5>
                            @endif
                        </td>
                    @endif
                    </tbody>
                </table>
                <div class="col-md-8 ml-auto">
                    {{ $users->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
