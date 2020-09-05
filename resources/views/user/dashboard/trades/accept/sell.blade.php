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
                                    @if($trade->buyer_transaction_stage == 1 && $trade->seller_transaction_stage == null && $trade->ace_transaction_stage == null)
                                        <div class="text-center">
                                            <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Buyer to Verify Wallet </strong>
                                            <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
                                        </div>
                                    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null && $trade->ace_transaction_stage == null)
                                        <div class="text-center">
                                            <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Buyer to Verify Wallet </strong>
                                            <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
                                        </div>
                                    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null && $trade->ace_transaction_stage == 1)
                                        <div class="text-center">
                                            <strong class="text-success" id="info-1-text" style="font-size: 23px">Wallet Verified, Proceed with Transaction</strong>
                                            <img width="100px" id="info-1-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
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
                                                <button type="button" id="step-2-nav"  class="btn btn-special px-5">Proceed</button>
                                            @else
                                                <button id="step-1-proceed" class="btn btn-special px-5">Accept Trade</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div id="chat-field" class="col-12 mx-auto p-0">
                                    @isset($trade)
                                        @if($trade->is_dispute == 1)
                                            @include('user.dashboard.trades.accept.partials.sell.chat')
                                        @endif
                                    @endisset
                                </div>
                                <div class="col-12 mx-auto p-0 my-3">
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

            $(".chat-field").animate({ scrollTop: 999999 }, 1000);
            // STEP 1
            $("#step-1").submit(function (e) {
                e.preventDefault();
                if(!$("#wallet-company").val()){
                    $("#error").text("Please select where your coin is coming from");
                    return
                }else{
                    $("#error").text("");
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
                        }else if (result.success == false){
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

