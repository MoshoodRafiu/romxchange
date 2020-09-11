@extends('layouts.admin')

@section('content')


    <h3 class="text-dark mb-4">Agents</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">Agents</p>
            <a class="btn btn-primary" href="{{ route('admin.agents.create') }}"><i class="fa fa-plus"></i> Register Agent</a>
        </div>
        <div class="card-body">
{{--            <div class="row">--}}
{{--                <div class="col-md-9 align-self-center">--}}
{{--                    @if(count($agents) > 0)--}}
{{--                        @if($search)--}}
{{--                            <h5 class="font-italic">Showing search result for <span class="font-weight-bold">'{{ $val }}'</span></h5>--}}
{{--                        @endif--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="col-md-3 ml-auto">--}}
{{--                    <form action="{{ route('admin.customers.filter') }}" method="get" class="d-flex mt-2 mb-4">--}}
{{--                        <input type="text" name="val" class="form-control form-control-sm" placeholder="Search">--}}
{{--                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="table-responsive">
                <table class="table table-hover table-responsive-lg">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Display Name</th>
                        <th>Email</th>
                        <th>Transactions</th>
                        <th>Registered</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    @if(count($agents) > 0)
                        @foreach($agents as $key=>$agent)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $agent->first_name }} {{ $agent->last_name }}</td>
                                <td>{{ $agent->display_name }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>{{ \App\Trade::where('agent_id', $agent->id)->where('transaction_status', 'success')->count() }}</td>
                                <td>@if($agent->created_at){{ $agent->created_at->diffForHumans() }}@else null @endif</td>
                                <td class="text-center d-flex">
                                    <button type="button" data-toggle="modal" data-target="#deleteModal{{ $agent->id }}" class="btn mx-1 @if($agent->is_active) btn-danger @else btn-success @endif">@if($agent->is_active) <i class="fas fa-user-alt-slash"></i> @else <i class="fas fa-user-check"></i> @endif</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $agent->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $agent->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $agent->id }}">Confirm</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to @if($agent->is_active) <span class="font-italic">Restrict</span> @else <span class="font-italic">Approve</span> @endif this Agent?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <form method="get" action="@if($agent->is_active) {{ route('admin.customers.restrict', $agent) }} @else {{ route('admin.customers.approve', $agent) }} @endif">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">@if($agent->is_active) Restrict @else Approve @endif Agent</button>
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
                                <h5 class="font-italic">No Agent(s) yet</h5>
                            @endif
                        </td>
                    @endif
                    </tbody>
                </table>
                <div class="col-md-8 ml-auto">
                    {{ $agents->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
