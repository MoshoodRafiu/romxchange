@extends('layouts.user')


@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">phone verification</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 mx-auto my-5">
                    <div class="card shadow">
                        <div class="card-body text-left">
                            <p>Enter your phone number below, click on <strong>Send Code</strong> a verification code will be sent to you via SMS</p>
                            <form action="" method="post" class="my-4">
                                <div class="form-group">
                                    <label for="document">Enter Phone</label>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-9 p-0 col-sm-8 col-6">
                                            <input type="tel" id="document" name="document" class="form-control" value="{{ Auth::user()->phone }}">
                                        </div>
                                        <div class="col-md-3 col-sm-4 text-right p-0 col-6">
                                            <button type="submit" class="btn btn-info">Send Code</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="code">Enter Code</label>
                                    <input type="number" id="code" name="code" class="form-control">
                                </div>
                                <div class="form-group text-center mt-3">
                                    <button type="submit" class="btn btn-special">Verify Phone</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
