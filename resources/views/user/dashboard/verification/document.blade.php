@extends('layouts.user')


@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">document verification</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 mx-auto my-5">
                    @if(Session::has('message'))
                        <div class="alert w-100 mx-auto alert-success text-left" role="alert">{{ session('message') }}</div>
                    @elseif(Session::has('error'))
                        <div class="alert w-100 mx-auto alert-danger text-left" role="alert">{{ session('error') }}</div>
                    @endif
                    <div class="card shadow">
                        <div class="card-body text-left">
                            @if(Auth::user()->verification)
                                @if(Auth::user()->verification->document_verification_status === "pending")
                                    <strong class="text-danger">Document undergoing verification, do not resend verification request.</strong>
                                @endif
                            @endif
                            <p>You are required to upload a clear picture of your face any of the documents listed below</p>
                            <ul>
                                <li>National ID Card</li>
                                <li>International Passport</li>
                                <li>Voters Card</li>
                            </ul>
                            <form action="{{ route('verification.document.store') }}" method="post" enctype="multipart/form-data" class="my-4">
                                @csrf
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    @error('photo')
                                    <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </div>
                                    @enderror
                                    <input type="file" id="photo" name="photo" class="form-control @error('photo') is-invalid @enderror" required>
                                </div>
                                <div class="form-group">
                                    <label for="document">Document</label>
                                    @error('document')
                                    <div>
                                        <span class="text-danger small" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </div>
                                    @enderror
                                    <input type="file" id="document" name="document" class="form-control @error('document') is-invalid @enderror" required>
                                </div>
                                <div class="form-group text-center mt-3">
                                    @if(Auth::user()->verification)
                                        @if(Auth::user()->verification->document_verification_status === "pending" || Auth::user()->verification->is_document_verified == 1)
                                            <button onclick="event.preventDefault();" type="button" class="btn btn-special" disabled>Upload Document</button>
                                        @else
                                            <button type="submit" class="btn btn-special">Upload Document</button>
                                        @endif
                                    @else
                                        <button type="submit" class="btn btn-special">Upload Document</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
