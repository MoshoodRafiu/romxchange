@extends('layouts.user')

@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px">Process transaction</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert w-100 col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert w-100 col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
                <div class="card text-left">
                    <div class="card-header bg-special">
                        <ul class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link step-info present" id="item-1-1-tab" data-toggle="tab" role="tab" aria-controls="item-1-1" aria-selected="true" href="#item-1-1">Trade Details <i id="step-icon-1" class="fa @isset($trade) @if($trade->buyer_transaction_stage >= 1) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-2-tab" data-toggle="tab" role="tab" aria-controls="item-1-2" aria-selected="false" href="#item-1-2">Verify Wallet  <i id="step-icon-2" class="fa @isset($trade) @if($trade->buyer_transaction_stage >= 2) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-3-tab" data-toggle="tab" role="tab" aria-controls="item-1-3" aria-selected="false" href="#item-1-3">Make Payment <i id="step-icon-3" class="fa @isset($trade) @if($trade->buyer_transaction_stage >= 3) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-4-tab" data-toggle="tab" role="tab" aria-controls="item-1-4" aria-selected="false" href="#item-1-4">Receive Coin <i id="step-icon-4" class="fa @isset($trade) @if($trade->buyer_transaction_stage >= 4) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                            <li class="nav-item"><a class="nav-link step-info" id="item-1-5-tab" data-toggle="tab" role="tab" aria-controls="item-1-5" aria-selected="false" href="#item-1-5">Rate Seller <i id="step-icon-5" class="fa @isset($trade) @if($trade->buyer_transaction_stage >= 5) fa-check-circle text-success @else fa-info-circle text-danger @endif @else fa-info-circle text-danger @endisset"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="nav-tabContent" class="tab-content">
                            <div id="item-1-1" class="tab-panel fade show active" role="tabpanel" aria-labelledby="item-1-1-tab">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small">
                                        <a href="{{ route('sms.summon', ['trade' => $trade, 'type' => 'seller']) }}" class="btn btn-sm btn-secondary">Summon via SMS</a>
                                        <a href="{{ route('mail.summon', ['trade' => $trade, 'type' => 'seller']) }}" class="btn btn-sm btn-info">Summon via Mail</a>
                                    </div>
                                    <h4 class="text-right text-danger"><span id="minute">00</span>.<span id="second">00</span></h4>
                                </div>
                                <div class="step">
                                    <h4 class="text-center my-4">Step 1</h4>
                                    @if($trade->is_dispute == 1)
                                        <div class="text-center">
                                            <strong class="text-warning" id="info-1-text" style="font-size: 23px">Trade Dispute, Use Dispute Chatbox Below</strong>
                                            <img width="30px" id="info-1-img" src="{{ asset('assets/img/warning.gif') }}" alt="proceed">
                                        </div>
                                    @endif
                                    <form class="row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="transactionID">Transaction ID</label>
                                                        <div class="d-flex ">
                                                <input type="text" name="transactionID" id="transactionID" value="{{ $trade->transaction_id }}" class="form-control col-sm-11 col-10" readonly>
                                                <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                                                <a onclick="copyText('transactionID')" class="col-sm-1 m-0 col-2 btn text-white btn-secondary"><i class="fas fa-copy"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="volume">Coin Amount </label>
                                                                   <input type="text" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" name="volume" id="volume" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="amount-usd">Amount in USD</label>
                                                                   <input type="text" name="amount-usd" id="amount-usd" value="{{ round($trade->coin_amount_usd, 2) }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="amount-ngn">Amount in NGN</label>
                                                                   <input type="text" name="amount-ngn" id="amount-ngn" value="{{ round($trade->coin_amount_ngn, 2) }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="charges">Account Number</label>
                                                                   <input type="text" name="accountNumber" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->account_number }}" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="charges">Bank Name</label>
                                            <input type="text" name="bankName" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->bank_name }}" class="form-control" disabled>
                                        </div>
                                        <div class="mx-auto text-center">
                                            <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn px-4 btn-danger">Cancel Trade</button>
                                            @if($trade->buyer_transaction_stage == null)
                                                <button type="submit" id="step-1-proceed" class="btn btn-special mx-4">Accept Trade</button>
                                            @else
                                                <button type="submit" id="step-2-nav" class="btn btn-special mx-4">Proceed</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div id="chat-field" class="col-12 mx-auto p-0 mb-5">
                                    @isset($trade)
                                        @if($trade->is_dispute == 1)
                                            @include('user.dashboard.trades.accept.partials.buy.chat')
                                        @endif
                                    @endisset
                                </div>
                                <div class="col-12 mx-auto p-0">
                                    @include('user.dashboard.trades.accept.partials.buy.info')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade text-left" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelModalLabel">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to cancel this trade?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form method="get" @isset($trade) action="{{ route('trade.switch', $trade) }}" @endisset>
                                @csrf
                                <button type="submit" class="btn btn-danger">Cancel Trade</button>
                            </form>
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
        var url = "{{ route('trade.index') }}";
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
                // window.location.replace(url);
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
            $(".step").on("click", "#step-1-proceed", function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('trade.accept.buy.step1', $trade) }}",
                    method: "GET",
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
                        }
                    }
                });
            });
            $(".step").on("click", "#step-1-disabled", function (e) {
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
                    url: "{{ route('trade.accept.buy.step2', $trade) }}",
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
                    url: "{{ route('trade.accept.buy.step3', $trade) }}",
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
                            // $("#item-1-4-tab").addClass("present");
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
                    url: "{{ route('trade.accept.buy.step4', $trade) }}",
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
                    url: "{{ route('trade.accept.buy.nav.step1', $trade) }}",
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

            $(".step").on("click", "#step-2-nav", function (e) {
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
                    url: "{{ route('trade.accept.buy.nav.step2', $trade) }}",
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

            $(".step").on("click", "#step-3-nav", function (e) {
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
                    url: "{{ route('trade.accept.buy.nav.step3', $trade) }}",
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

            $(".step").on("click", "#step-4-nav", function (e) {
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
                    url: "{{ route('trade.accept.buy.nav.step4', $trade) }}",
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

            $(".step").on("click", "#step-5-nav", function (e) {
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
                    url: "{{ route('trade.accept.buy.nav.step5', $trade) }}",
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

            $(".tab-panel").on('click', '#message-1', function (e) {
                e.preventDefault();
                sendMessage("1");
            });

            $(".tab-panel").on('click', '#message-2', function (e) {
                e.preventDefault();
                sendMessage("2");
            });
            $(".tab-panel").on('click', '#message-3', function (e) {
                e.preventDefault();
                sendMessage("3");
            });

            $(".tab-panel").on('click', '#message-4', function (e) {
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


            $(".tab-panel").on('click', '#payment-proof-button', function (e) {
                e.preventDefault();
                $("#payment-proof-file").click();
            });

            $(".tab-panel").on('change', '#payment-proof-form', function (e) {
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

            channel.listen('.payment-verified', function() {
                $("#info-3-text").text('Payment Verified, Proceed with Transaction');
                $("#info-3-text").removeClass('text-info');
                $("#info-3-text").addClass('text-success');
                $("#info-3-img").attr('src', '{{ asset('assets/img/proceed.gif') }}');
                $("#info-3-img").width('100');
            });

            channel.listen('.switch-trade', function() {
                $("#info-1-text").text('Agent Cancelled Trade, Trade Window Will now Close');
                $("#info-1-text").removeClass('text-warning');
                $("#info-1-text").addClass('text-danger');
                $("#info-1-img").attr('src', '{{ asset('assets/img/cancel.gif') }}');
                $("#info-1-img").width('50');

                $("#info-3-text").text('Agent Cancelled Trade, Trade Window Will now Close');
                $("#info-3-text").removeClass('text-info');
                $("#info-3-text").addClass('text-danger');
                $("#info-3-img").attr('src', '{{ asset('assets/img/cancel.gif') }}');
                $("#info-3-img").width('50');
                var url = "{{ route('trade.index') }}";
                window.setTimeout(function(){
                    window.location.replace(url);
                }, 3000);
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
        });
    </script>

@endsection
