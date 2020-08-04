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
                            <li class="nav-item"><a class="nav-link step-info present" id="item-1-1-tab" data-toggle="tab" role="tab" aria-controls="item-1-1" aria-selected="true" href="#item-1-1">Coin Volume <i id="step-icon-1" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 1) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-2-tab" data-toggle="tab" role="tab" aria-controls="item-1-2" aria-selected="false" href="#item-1-2">Coin Deposit <i id="step-icon-2" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 2) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-3-tab" data-toggle="tab" role="tab" aria-controls="item-1-3" aria-selected="false" href="#item-1-3">Acknowledge Payment <i id="step-icon-3" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 3) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-4-tab" data-toggle="tab" role="tab" aria-controls="item-1-4" aria-selected="false" href="#item-1-4">Release Coin <i id="step-icon-4" class="fa @isset($trade) @if($trade->seller_transaction_stage >= 4) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-5-tab" data-toggle="tab" role="tab" aria-controls="item-1-5" aria-selected="false" href="#item-1-5">Rate Buyer <i id="step-icon-5" class="fa @isset($trade) @if($trade->seller_transaction_stage === 5) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="nav-tabContent" class="tab-content">
                            <div id="item-1-1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="item-1-1-tab">
                                <div class="step">
                                    <h4 class="text-center my-4">Step 1</h4>
                                    <div class="text-center">
                                        <strong class="text-info" style="font-size: 23px">Waiting For Buyer to Accept Trade </strong>
                                        <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
                                    </div>
                                    <div><strong id="error" class="text-danger"></strong></div>
                                    <form class="row mb-4" method="POST" id="step-1">
                                        @csrf
                                        <div class="form-group col-md-6">
                                            <label>Coin Amount <span class="range font-weight-bold mx-2 text-capitalize">Min: {{ $market->min }} <span class="font-weight-light">{{ $market->coin->abbr }}</span></span><span class="range font-weight-bold text-capitalize mx-2">Max: {{ $market->max }} <span class="font-weight-light">{{ $market->coin->abbr }}</span></span></label>
                                            @isset($trade)
                                                <input type="text" name="volume" id="amount" value="{{ $trade->coin_amount }}" disabled class="form-control">
                                            @else
                                                <input type="text" name="volume" id="amount"  class="form-control">
                                            @endisset
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount in USD</label>
                                            <input type="text" name="amount_usd" id="amount_usd" value="{{ $market->price_usd }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount in NGN</label>
                                            <input type="text" name="amount_ngn" id="amount_ngn" value="{{ $market->price_ngn }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Transaction Charges</label>
                                            <input type="number" name="charges" value="0.000056" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div><strong id="error-wallet" class="text-danger"></strong></div>
                                            <label>Wallet Compnay</label>
                                            @isset($trade)
                                                <select name="wallet" id="wallet-company" class="form-control" disabled>
                                                    <option value="">Select Wallet You Are Sending From</option>
                                                    @foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $market->coin_id)->get() as $wallet)
                                                        <option value="{{ $wallet->company }}" @if($trade->seller_wallet_company === $wallet->company) selected @endif>{{ $wallet->company }}</option>
                                                    @endforeach
                                                    <option value="others" @if($trade->seller_wallet_company === "others") selected @endif>Others</option>
                                                </select>
                                            @else
                                                <select name="wallet" id="wallet-company" class="form-control">
                                                    <option value="">Select Wallet You Are Sending From</option>
                                                    @foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $market->coin_id)->get() as $wallet)
                                                        <option value="{{ $wallet->company }}">{{ $wallet->company }}</option>
                                                    @endforeach
                                                    <option value="others">Others</option>
                                                </select>
                                            @endisset
                                        </div>
                                        <div class="mx-auto">
                                            @isset($trade)
                                                <button type="submit" id="step-2-nav"  class="btn btn-special px-5">Proceed</button>
                                            @else
                                                <button id="step-1-proceed" class="btn btn-special px-5">Proceed</button>
                                            @endisset
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 mx-auto">
                                    @include('user.dashboard.trades.initiate.partials.sell.info')
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
            $("#amount").bind('keyup change', function () {
                if (isNaN($("#amount").val()) || parseFloat($("#amount").val()) < {{ $market->min }} || parseFloat($("#amount").val()) > {{ $market->max }}){
                    $("#error").text("Please input a valid amount of coin")
                    $("#amount_usd").val("");
                    $("#amount_ngn").val("");
                }else{
                    $("#error").text("");
                    $("#amount_usd").val(($("#amount").val() * {{ $market->price_usd }}).toFixed(2) );
                    $("#amount_ngn").val(($("#amount").val() * {{ $market->price_ngn }}).toFixed(2) );
                }
            })
            $("#wallet-company").bind('keyup change', function () {
                if (!$("#wallet-company").val()){
                    $("#error-wallet").text("Please select wallet company your coin is coming from")
                }else{
                    $("#error-wallet").text("");
                }
            })
            $(".step").on('click', '#step-1-proceed',function (e) {
                e.preventDefault();
                if (isNaN($("#amount").val()) || parseFloat($("#amount").val()) < {{ $market->min }} || parseFloat($("#amount").val()) > {{ $market->max }} || $("#amount").val() === ""){
                    $("#error").text("Please input a valid amount of coin")
                    return
                }else if(!$("#wallet-company").val()){
                    $("#error-wallet").text("Please select wallet company your coin is coming from")
                    return
                }
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.initiate.sell.step1') }}",
                    method: "POST",
                    data: {
                        amount: $("#amount").val(),
                        company: $("#wallet-company").val(),
                        market: {{ $market->id }}
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
                            location.reload();
                        }else{
                            $("#error").text("Please fill all fields")
                        }
                    }
                });
            });

            $(".step").on("click", "#step-1-disabled", function (e) {
                e.preventDefault();
            })

            // STEP 2

            $(".step").on('click', '#step-2-proceed', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                @isset($trade)
                $.ajax({
                    url: "{{ route('trade.initiate.sell.step2') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }}
                    },
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
                            $("#step-icon-2").removeClass("fa-info-circle text-danger");
                            $("#step-icon-2").addClass("fa-check-circle text-success");
                        }
                    }
                });
                @endisset
            });

            // STEP 3

            $(".step").on('click', '#step-3-proceed', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                @isset($trade)
                $.ajax({
                    url: "{{ route('trade.initiate.sell.step3') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }}
                    },
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
                @endisset
            });

            // STEP 4

            $(".step").on('click', '#step-4-proceed', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                @isset($trade)
                $.ajax({
                    url: "{{ route('trade.initiate.sell.step4') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }}
                    },
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
                @endisset
            });


            //NAVIGATIONS TAB-1


            $("#item-1-1-tab").click(function (e) {
                e.preventDefault();
                nav1();
            });

            var nav1 = function(){
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                @isset($trade)
                $.ajax({
                    url: "{{ route('trade.initiate.sell.nav.step1') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }}
                    },
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
                @endisset
            }

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
                @isset($trade)
                $.ajax({
                    url: "{{ route('trade.initiate.sell.nav.step2') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }}
                    },
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
                @endisset
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
                @isset($trade)
                $.ajax({
                    url: "{{ route('trade.initiate.sell.nav.step3') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }}
                    },
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
                @endisset
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
                @isset($trade)
                $.ajax({
                    url: "{{ route('trade.initiate.sell.nav.step4') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }}
                    },
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
                @endisset
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
                @isset($trade)
                $.ajax({
                    url: "{{ route('trade.initiate.sell.nav.step5') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }}
                    },
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
                @endisset
            }
        });
    </script>

@endsection
