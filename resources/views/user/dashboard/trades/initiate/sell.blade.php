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
                @if(Session::has('success'))
                    <div class="alert w-100 col-12 alert-success text-left" role="alert">{{ session('success') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert w-100 col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
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
                                @isset($trade)
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small">
                                        <a href="{{ route('sms.summon', ['trade' => $trade, 'type' => 'buyer']) }}" class="btn my-1 my-md-0 btn-sm btn-secondary">Summon via SMS</a>
                                        <a href="{{ route('mail.summon', ['trade' => $trade, 'type' => 'buyer']) }}" class="btn my-1 my-md-0 btn-sm btn-info">Summon via Mail</a>
                                    </div>
                                    <h4 class="text-right text-danger"><span id="minute">00</span>.<span id="second">00</span></h4>
                                </div>
                                @endisset
                                <div class="step">
                                    <h4 class="text-center my-4">Step 1</h4>
                                    @if(isset($trade))
                                        @if($trade->transaction_status == "cancelled")
                                            <div class="text-center">
                                                <strong class="text-danger" style="font-size: 23px">Trade Cancelled, Close Trade Window</strong>
                                                <img width="50px" src="{{ asset('assets/img/cancel.gif') }}" alt="cancel">
                                            </div>
                                        @else
                                            @if($trade->is_dispute == 1)
                                                <div class="text-center">
                                                    <strong class="text-warning" id="info-1-text" style="font-size: 23px">Trade Dispute, Use Dispute Chatbox Below</strong>
                                                    <img width="30px" id="info-1-img" src="{{ asset('assets/img/warning.gif') }}" alt="proceed">
                                                </div>
                                            @endif
                                            @if(($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == null) || ($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 1) || ($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == null))
                                                <div class="text-center" id="transaction-message">
                                                    <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Buyer to Accept Trade </strong>
                                                    <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
                                                </div>
                                            @elseif($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
                                                <div class="text-center" id="transaction-message">
                                                    <strong class="text-success" id="info-1-text" style="font-size: 23px">Trade Accepted, Proceed with Trade Below</strong>
                                                    <img width="100px" id="info-1-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
                                                </div>
                                            @endif
                                        @endif
                                    @endisset
                                    <div class="text-center"><strong id="error" class="text-danger"></strong></div>
                                    <form class="row mb-4" method="POST" id="step-1">
                                        @isset($trade)
                                            <div class="form-group col-md-12">
                                                <label for="transactionID">Transaction ID</label>
                                                            <div class="d-flex ">
                                                    <input type="text" name="transactionID" id="transactionID" value="{{ $trade->transaction_id }}" class="form-control col-sm-11 col-10" readonly>
                                                    <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                                                    <a onclick="copyText('transactionID')" class="col-sm-1 m-0 col-2 btn text-white btn-secondary"><i class="fas fa-copy"></i></a>
                                                </div>
                                            </div>
                                        @endisset
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
                                            <input type="text" name="amount_usd" id="amount_usd" value="@isset($data) 0.00 @else @isset($trade) {{ round($trade->coin_amount_usd, 2) }} @endisset @endisset" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Amount in NGN</label>
                                            <input type="text" name="amount_ngn" id="amount_ngn" value="@isset($data) 0.00 @else @isset($trade) {{ round($trade->coin_amount_ngn, 2) }} @endisset @endisset" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Wallet Company</label>
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
                                            <div><strong id="error-wallet" class="text-danger"></strong></div>
                                        </div>
                                        <div class="mx-auto text-center" id="trade-cancel">
                                            @isset($trade)
                                                @if($trade->transaction_status == "cancelled")
                                                    <a href="{{ route('trade.index') }}"  class="btn btn-info px-5">Close Trade Window</a>
                                                @else
                                                    <button type="button" id="step-2-nav"  class="btn btn-special px-5">Proceed</button>
                                                @endif
                                            @else
                                                <button id="step-1-proceed" class="btn btn-special px-5">Proceed</button>
                                            @endisset
                                        </div>
                                    </form>
                                </div>
                                <div id="chat-field" class="col-12 mx-auto p-0 mb-5">
                                    @isset($trade)
                                        @if($trade->is_dispute == 1)
                                            @include('user.dashboard.trades.initiate.partials.sell.chat')
                                        @endif
                                    @endisset
                                </div>
                                <div class="col-12 mx-auto p-0">
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
            @isset($trade)
        var cancel_time = "{{ date('F j, Y H:i:s', strtotime($trade->trade_window_expiry)) }}";
        var url = "{{ route('trade.cancel', $trade) }}";
        // Set the date we're counting down to
        var countDownDate = new Date(cancel_time).getTime();

        function formatNumber(num, len) {
            var s = num+"";
            while (s.length < len) s = "0" + s;
            return s;
        }

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("minute").innerText = formatNumber(minutes, 2);
            document.getElementById("second").innerText = formatNumber(seconds, 2);

            // If the count down is over, write some text
            if (distance < 0) {
                @if($trade->buyer_transaction_stage == null)
                    window.location.replace(url);
                @endif
                clearInterval(x);
                document.getElementById("minute").innerText = "00";
                document.getElementById("second").innerText = "00";
            }
        }, 1000);
        @endisset
    </script>


    <script>
        $(document).ready(function () {

            $(".chat-field").animate({ scrollTop: 999999 }, 1000);
            // STEP 1
            $("#amount").bind('keyup change', function () {
                if (isNaN($("#amount").val()) || parseFloat($("#amount").val()) < {{ $market->min }} || parseFloat($("#amount").val()) > {{ $market->max }}){
                    $("#error").text("Please input a valid amount of coin")
                    $("#amount_usd").val("");
                    $("#amount_ngn").val("");
                    $("#charge").val("");
                }else{
                    $("#error").text("");
                    var charge = ({{ \App\Setting::all()->first()->charges / 100}}) * $("#amount").val();
                    var usd = @isset($data) {{ $data[0]['price'] }}; @else 0.00; @endisset
                    var ngn = @isset($data) {{ $market->rate * $data[0]['price'] }}; @else 0.00; @endisset
                    $("#amount_usd").val((($("#amount").val() - (charge / 2)) * usd).toFixed(2));
                    $("#amount_ngn").val((($("#amount").val() - (charge / 2)) *  ngn).toFixed(2));
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
                            $("#error").text(result.error);
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
                        $('#message').show();
                        if (result.success) {
                            $(".step").fadeIn().html(result.html);
                            // $(".step-info").removeClass("present");
                            // $("#item-1-3-tab").addClass("present");
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

        $(".tab-pane").on('click', '#message-1', function (e) {
            e.preventDefault();
            sendMessage("1");
        });

        $(".tab-pane").on('click', '#message-2', function (e) {
            e.preventDefault();
            sendMessage("2");
        });
        $(".tab-pane").on('click', '#message-3', function (e) {
            e.preventDefault();
            sendMessage("3");
        });

        $(".tab-pane").on('click', '#message-4', function (e) {
            e.preventDefault();
            sendMessage("4");
        });

            @isset($trade)
        var sendMessage = function (val) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('message.send') }}",
                    method: "POST",
                    data: {
                        trade: {{ $trade->id }},
                        message: val,
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
                            $("#chat-field").fadeIn().html(result.html);
                            $(".chat-field").animate({ scrollTop: 999999 }, 1000);
                            // document.querySelector('.chat-field').scrollTo({ left: 0, top: document.body.scrollHeight});
                        }
                    }
                });
            }
        @endisset

        $(".tab-pane").on('click', '#payment-proof-button', function (e) {
            e.preventDefault();
            $("#payment-proof-file").click();
        });

        $(".tab-pane").on('change', '#payment-proof-form', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                }
            });
            $.ajax({
                url: "{{ route('message.file.send') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: formData,
                cache: false,
                beforeSend: function () {
                    $(".ajax-loader").show();
                },
                complete: function () {
                    $(".ajax-loader").hide();
                },
                success: function (result) {
                    if (result.success) {
                        $("#chat-field").fadeIn().html(result.html);
                        $(".chat-field").animate({scrollTop: 999999}, 1000);
                        // document.querySelector('.chat-field').scrollTo({ left: 0, top: document.body.scrollHeight});
                    }
                }

            });
        });

        @isset($trade)
        var channel = Echo.private('trade.{{ $trade->id }}');
        channel.listen('.coin-verified', function() {
            $("#info-2-text").text('Coin Verified, Proceed with Transaction');
            $("#info-2-text").removeClass('text-info');
            $("#info-2-text").addClass('text-success');
            $("#info-2-img").attr('src', '{{ asset('assets/img/proceed.gif') }}');
            $("#info-2-img").width('100');
        });

        channel.listen('.trade-cancelled', function() {
            $("#info-1-text").text('Trade Cancelled, Close Trade Window');
            $("#info-1-text").removeClass('text-info');
            $("#info-1-text").addClass('text-danger');
            $("#info-1-img").attr('src', '{{ asset('assets/img/cancel.gif') }}');
            $("#info-1-img").width('50');

            $("#info-2-text").text('Trade Cancelled, Close Trade Window');
            $("#info-2-text").removeClass('text-info');
            $("#info-2-text").addClass('text-danger');
            $("#info-2-img").attr('src', '{{ asset('assets/img/cancel.gif') }}');
            $("#info-2-img").width('50');

            $("#info-3-text").text('Trade Cancelled, Close Trade Window');
            $("#info-3-text").removeClass('text-info');
            $("#info-3-text").addClass('text-danger');
            $("#info-3-img").attr('src', '{{ asset('assets/img/cancel.gif') }}');
            $("#info-3-img").width('50');

            var link = '{{ route('trade.index') }}';
            $('#trade-cancel').html('<a href="'+ link +'" class="btn btn-info p-2">Close Trade Window</a>');
        });

        channel.listen('.switch-trade', function() {
            $("#info-3-text").text('Buyer Cancelled Trade, AcexWorld agent is Now Going to Make Payment, Kindly Wait For Your Payment');
            $("#info-3-text").removeClass('text-success');
            $("#info-3-text").addClass('text-info');
            $("#info-3-text").css('font-size', "20px");
            $("#info-3-img").attr('src', '{{ asset('assets/img/waiting.gif') }}');
            $("#info-3-img").width('50');
        });

        channel.listen('.payment-made', function() {
            $("#info-3-text").text('Payment Made, Verify Payment and Proceed');
            $("#info-3-text").removeClass('text-info');
            $("#info-3-text").addClass('text-success');
            $("#info-3-img").attr('src', '{{ asset('assets/img/proceed.gif') }}');
            $("#info-3-img").width('100');
        });

        channel.listen('.trade-accepted', function() {
            $("#info-1-text").text('Wallet Verified, Proceed with Transaction');
            $("#info-1-text").removeClass('text-info');
            $("#info-1-text").addClass('text-success');
            $("#info-1-img").attr('src', '{{ asset('assets/img/proceed.gif') }}');
            $("#info-1-img").width('100');
        });

        channel.listen('.trade-dispute', function() {
            location.reload();
        });

        channel.listen('.agent-joined', function() {

            const div = document.createElement('div');
            div.innerHTML = `<div class="chat-info">Agent joined the chat</div>`;

            document.querySelector('.chat-field').appendChild(div);
            $(".chat-field").animate({ scrollTop: 999999 }, 1000);
        });

        channel.listen('.message-sent', function(data) {

            if(data.id !== {{ \Illuminate\Support\Facades\Auth::user()->id }}){
                const div = document.createElement('div');

                if(data.sender === "agent"){
                    div.className = 'agent';
                }else {
                    div.className = 'received';
                }

                if(data.type === "text"){
                    div.innerHTML = `
                    <span class="owner">${data.sender}</span>
                    <span>${data.message}</span>
                    <span class="time">${data.time}</span>`;
                }else{
                    var getUrl = window.location;
                    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[0];
                    var imgUrl = baseUrl+'proofs/'+data.message
                    div.innerHTML = `
                    <span class="owner">${data.sender}</span>
                    <div class="text-center"><img class="img img-fluid p-3" src="${imgUrl}" alt="img"></div>
                    <span class="time">${data.time}</span>`;
                }

                document.querySelector('.chat-field').appendChild(div);
                $(".chat-field").animate({ scrollTop: 999999 }, 1000);
            }
        });

        $(".step").on("click", ".star-rating .fa", function () {
            $('.star-rating .fa').removeClass('fa-star-o')
            $('.star-rating .fa').removeClass('fa-star')
            $('.star-rating .fa').removeClass('fa-3x')
            $('.star-rating .fa').addClass('fa-2x')
            $(this).addClass('fa-star');
            $(this).removeClass('fa-2x');
            $(this).addClass('fa-3x');
            $(this).addClass('fa-3x').delay(500).queue(function( next ){
                $(this).removeClass('fa-3x');
                $(this).addClass('fa-2x');
                next();
            });

            var id = $(this).data('rating');
            $(this).siblings('span').each(function () {
                if ($(this).data('rating') < id){
                    $(this).addClass('fa-star');
                }else{
                    $(this).addClass('fa-star-o');
                }
            })

            $('#star-rating').val(id);

        });

        @endisset

    </script>

@endsection
