@extends('layouts.user')

@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">Process Transaction</h2>
                </div>
            </div>
            <div class="row">
                <div class="card text-left">
                    <div class="card-header bg-special">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link step-info present" id="item-1-1-tab" data-toggle="tab" role="tab" aria-controls="item-1-1" aria-selected="true" href="#item-1-1">Trade Details <i id="step-icon-1" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 1) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-2-tab" data-toggle="tab" role="tab" aria-controls="item-1-2" aria-selected="false" href="#item-1-2">Coin Deposit <i id="step-icon-2" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 2) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-3-tab" data-toggle="tab" role="tab" aria-controls="item-1-3" aria-selected="false" href="#item-1-3">Acknowledge Payment <i id="step-icon-3" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 3) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-4-tab" data-toggle="tab" role="tab" aria-controls="item-1-4" aria-selected="false" href="#item-1-4">Release Coin <i id="step-icon-4" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 4) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-5-tab" data-toggle="tab" role="tab" aria-controls="item-1-5" aria-selected="false" href="#item-1-5">Rate Buyer <i id="step-icon-5" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 5) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="nav-tabContent" class="tab-content">
                            <div id="item-1-1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="item-1-1-tab">
                                <div class="step">
                                    <h4 class="text-center my-4">Step 1</h4>
                                    @if($trade->buyer_transaction_stage == 1 && $trade->seller_transaction_stage == null)
                                        <div class="text-center">
                                            <strong class="text-info" style="font-size: 23px">Waiting For Buyer to Verify Wallet </strong>
                                            <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
                                        </div>
                                    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null)
                                        <div class="text-center">
                                            <strong class="text-success" style="font-size: 23px">Wallet Verified, Proceed with Transaction</strong>
                                            <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
                                        </div>
                                    @endif
                                    <form class="row mb-4" id="step-1">
                                        <div class="form-group col-md-6">
                                            <label>Coin Amount</label>
                                            <input type="type" name="amount" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount in USD</label>
                                            <input type="text" name="amount-usd" value="{{ $trade->coin_amount_usd }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount in NGN</label>
                                            <input type="text" name="amount-ngn" value="{{ $trade->coin_amount_ngn }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Transaction Charges</label>
                                            <input type="number" name="charges" value="{{ $trade->transaction_charge_coin }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Wallet Company</label>
                                            <div><strong id="error" class="text-danger"></strong></div>
                                            @if(!$trade->seller_transaction_stage == null)
                                                <select name="wallet" id="wallet-company" class="form-control" disabled>
                                                    <option value="">Select Wallet You Are Sending From</option>
                                                    @foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $trade->market->coin_id)->get() as $wallet)
                                                        <option value="{{ $wallet->company }}" @if($trade->seller_wallet_company === $wallet->company) selected @endif>{{ $wallet->company }}</option>
                                                    @endforeach
                                                    <option value="others" @if($trade->seller_wallet_company === "others") selected @endif>Others</option>
                                                </select>
                                            @else
                                                <select name="wallet" id="wallet-company" class="form-control">
                                                    <option value="">Select Wallet You Are Sending From</option>
                                                    @foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $trade->market->coin_id)->get() as $wallet)
                                                        <option value="{{ $wallet->company }}">{{ $wallet->company }}</option>
                                                    @endforeach
                                                    <option value="others">Others</option>
                                                </select>
                                            @endif
                                        </div>
                                        <div class="mx-auto">
                                            @if(!$trade->seller_transaction_stage == null)
                                                <button type="submit" id="step-2-nav"  class="btn btn-special px-5">Proceed</button>
                                            @else
                                                <button id="step-1-proceed" class="btn btn-special px-5">Accept Trade</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 mx-auto">
                                    @include('user.dashboard.trades.accept.partials.sell.info')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            // STEP 1
            $("#step-1").submit(function (e) {
                e.preventDefault();
                if(!$("#wallet-company").val()){
                    $("#error").text("Please select where your coin is coming from")
                    return
                }
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.step1') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }},
                        company: $("#wallet-company").val(),
                    },
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success){
                            $(".step").fadeIn().html(result.html);
                            $(".step-info").removeClass("present");
                            $("#item-1-2-tab").addClass("present");
                            $("#step-icon-1").removeClass("fa-info-circle text-danger");
                            $("#step-icon-1").addClass("fa-check-circle text-success");
                        }else{
                            $("#error").text("Please select where your coin is coming from")
                        }
                    }
                });
            });

            $(".step").on('click', '#step-1-disabled', function (e) {
                e.preventDefault();
            });

            // STEP 2

            $(".step").on('click', '#step-2-proceed', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.step2', $trade) }}",
                    method: "GET",
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            // $(".step-info").removeClass("present");
                            // $("#item-1-3-tab").addClass("present");
                            $("#step-icon-2").removeClass("fa-info-circle text-danger");
                            $("#step-icon-2").addClass("fa-check-circle text-success");
                        }
                    }
                });
            });

            // STEP 3

            $(".step").on('click', '#step-3-proceed', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.step3', $trade) }}",
                    method: "GET",
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            $(".step-info").removeClass("present");
                            $("#item-1-4-tab").addClass("present");
                            $("#step-icon-3").removeClass("fa-info-circle text-danger");
                            $("#step-icon-3").addClass("fa-check-circle text-success");
                        }
                    }
                });
            });

            // STEP 4

            $(".step").on('click', '#step-4-proceed', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.step4', $trade) }}",
                    method: "GET",
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            $(".step-info").removeClass("present");
                            $("#item-1-5-tab").addClass("present");
                            $("#step-icon-4").removeClass("fa-info-circle text-danger");
                            $("#step-icon-4").addClass("fa-check-circle text-success");
                        }
                    }
                });
            });


            //NAVIGATIONS TAB-1

            $("#item-1-1-tab").click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.nav.step1', $trade) }}",
                    method: "GET",
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            $(".step-info").removeClass("present");
                            $("#item-1-1-tab").addClass("present");
                        }
                    }
                });
            });

            //NAVIGATIONS TAB-2

            $(".step").on('click', '#step-2-nav', function (e) {
                e.preventDefault();
                nav2();
            });

            $("#item-1-2-tab").click(function (e) {
                e.preventDefault();
                nav2();
            });

            var nav2 = function(){
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.nav.step2', $trade) }}",
                    method: "GET",
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            $(".step-info").removeClass("present");
                            $("#item-1-2-tab").addClass("present");
                        }
                    }
                });
            }

            //NAVIGATIONS TAB-3

            $(".step").on('click', '#step-3-nav', function (e) {
                e.preventDefault();
                nav3();
            });

            $("#item-1-3-tab").click(function (e) {
                e.preventDefault();
                nav3();
            });

            var nav3 = function(){
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.nav.step3', $trade) }}",
                    method: "GET",
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            $(".step-info").removeClass("present");
                            $("#item-1-3-tab").addClass("present");
                        }
                    }
                });
            }

            //NAVIGATIONS TAB-4

            $(".step").on('click', '#step-4-nav', function (e) {
                e.preventDefault();
                nav4();
            });

            $("#item-1-4-tab").click(function (e) {
                e.preventDefault();
                nav4();
            });

            var nav4 = function(){
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.nav.step4', $trade) }}",
                    method: "GET",
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            $(".step-info").removeClass("present");
                            $("#item-1-4-tab").addClass("present");
                        }
                    }
                });
            }

            //NAVIGATIONS TAB-5

            $(".step").on('click', '#step-5-nav', function (e) {
                e.preventDefault();
                nav5();
            });

            $("#item-1-5-tab").click(function (e) {
                e.preventDefault();
                nav5();
            });

            var nav5 = function () {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.sell.nav.step5', $trade) }}",
                    method: "GET",
                    cache: false,
                    beforeSend: function () {
                        $(".ajax-loader").show();
                    },
                    complete: function () {
                        $(".ajax-loader").hide();
                    },
                    success: function (result) {
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            $(".step-info").removeClass("present");
                            $("#item-1-5-tab").addClass("present");
                        }
                    }
                });
            }
        });
    </script>

@endsection

