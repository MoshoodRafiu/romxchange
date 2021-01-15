@extends('layouts.admin')

@section('content')


    <h3 class="text-dark mb-4">Verification for {{ $verification->user->display_name }}</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <p class="text-primary m-0 font-weight-bold">{{ $verification->user->display_name }}'s Verification Details</p>
        </div>
        <div class="card-body">
            <table class="table table-borderless table-responsive-lg col-md-10">
                <tr>
                    <td><h5>Display Name:</h5></td>
                    <td><h5><span class="small">{{ $verification->user->display_name }}</span></h5></td>
                </tr>
                <tr>
                    <td><h5>Full Name:</h5></td>
                    <td><h5><span class="small">@if ($verification->user->last_name && $verification->user->first_name){{ $verification->user->last_name }} {{ $verification->user->first_name }}@else <span class="font-italic">Not yet updated</span>@endif</span></h5></td>
                </tr>
                <tr>
                    <td><h5>Email:</h5></td>
                    <td><h5><span class="small">{{ $verification->user->email }}</span></h5></td>
                </tr>
                <tr>
                    <td><h5>Phone:</h5></td>
                    <td><h5><span class="small">@if ($verification->user->phone){{ $verification->user->phone }}@else <span class="font-italic">Not yet updated</span>@endif</span></h5></td>
                </tr>
                <tr>
                    <td><h5>Verification:</h5></td>
                    <td>
                        <h5>
                            <span class="mr-5 small">Email @if($verification) <i class="fa fa-circle @if($verification->is_email_verified) text-success @else text-danger @endif"></i> @else <i class="fa fa-circle text-danger"></i> @endif</span>
                            <span class="mr-5 small">Phone @if($verification) <i class="fa fa-circle @if($verification->is_phone_verified) text-success @else text-danger @endif"></i> @else <i class="fa fa-circle text-danger"></i> @endif</span>
                            <span class="mr-5 small">Document @if($verification) <i class="fa fa-circle @if($verification->is_document_verified) text-success @elseif($verification->document_verification_status == "pending") text-warning  @else text-danger @endif"></i> @else <i class="fa fa-circle text-danger"></i> @endif</span>
                        </h5>
                    </td>
                </tr>
            </table>
            <div class="col-md-12">
                <h5>Document:</h5>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('/documents/'.$verification->user->documents()->latest()->first()->photo_url) }}" alt="document" class="img img-fluid">
                        <div class="text-center my-2">
                            <a href="#" class="btn btn-special btn-sm"><i class="fa fa-save"></i> Save</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('/documents/'.$verification->user->documents()->latest()->first()->document_url) }}" alt="document" class="img img-fluid">
                        <div class="text-center my-2">
                            <a href="#" class="btn btn-special btn-sm"><i class="fa fa-save"></i> Save</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center my-4">
                @if($verification->document_verification_status == "pending" && $verification->is_document_verified == 0)
                    <button class="btn btn-danger mx-3" data-toggle="modal" data-target="#declineModal{{ $verification->id }}">Decline</button>
                    <button class="btn btn-success mx-3" data-toggle="modal" data-target="#approveModal{{ $verification->id }}">Approve</button>
                @else
                    <button class="btn btn-danger mx-3" disabled>Decline</button>
                    <button class="btn btn-success mx-3" disabled>Approve</button>
                @endif
            </div>

            <!-- Approve Modal -->
            <div class="modal fade" id="approveModal{{ $verification->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel{{ $verification->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="approveModalLabel{{ $verification->id }}">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to <span class="font-weight-bold text-success">approve</span> {{ $verification->user->display_name }}'s documents?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <a href="{{ route('admin.verifications.approve', $verification) }}" class="btn btn-success">Approve</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decline Modal -->
            <div class="modal fade" id="declineModal{{ $verification->id }}" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel{{ $verification->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="declineModalLabel{{ $verification->id }}">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to <span class="font-weight-bold text-danger">decline</span> {{ $verification->user->display_name }}'s documents?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <a href="{{ route('admin.verifications.decline', $verification) }}" class="btn btn-success">Decline</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
