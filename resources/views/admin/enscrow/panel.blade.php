@extends('layouts.admin')

@section('content')

    <h3 class="text-dark mb-4">Enscrow Service</h3>
    <div class="card text-left">
        <div class="card-header bg-special">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link step-info present" id="item-1-1-tab" data-toggle="tab" role="tab" aria-controls="item-1-1" aria-selected="true" href="#item-1-1">Acknowledge Coin <i id="step-icon-1" class="fa @if($trade->ace_transaction_stage >= 1) fa-check-circle text-success @else fa-info-circle text-danger @endif"></i></a></li>
                <li class="nav-item"><a class="nav-link step-info" id="item-1-2-tab" data-toggle="tab" role="tab" aria-controls="item-1-2" aria-selected="false" href="#item-1-2">Settle Transaction <i id="step-icon-2" class="fa @if($trade->ace_transaction_stage >= 2) fa-check-circle text-success @else fa-info-circle text-danger @endif"></i></a></li>
                <li class="nav-item"><a class="nav-link step-info" id="item-1-3-tab" data-toggle="tab" role="tab" aria-controls="item-1-3" aria-selected="false" href="#item-1-3">Finish <i id="step-icon-3" class="fa @if($trade->ace_transaction_stage > 2) fa-check-circle text-success @else fa-info-circle text-danger @endif"></i></a></li>
            </ul>
        </div>
        <div class="card-body">
            <div id="nav-tabContent" class="tab-content">
                <div id="item-1-1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="item-1-1-tab">
                    <div class="step">
                        <h4 class="text-center my-4">Acknowledge Coin</h4>
                        @if(($trade->buyer_transaction_stage <= 2 && $trade->seller_transaction_stage < 2))
                            <div class="text-center">
                                <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Seller to Deposit Coin </strong>
                                <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
                            </div>
                        @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
                            <div class="text-center">
                                <strong class="text-success" id="info-1-text" style="font-size: 23px">Coin Deposited, Verify Coin and Proceed</strong>
                                <img width="100px" id="info-1-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
                            </div>
                        @elseif(($trade->buyer_transaction_stage < 3 && $trade->seller_transaction_stage < 3 && $trade->ace_transaction_stage == 2) || ($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage < 3 && $trade->ace_transaction_stage == 2) || ($trade->buyer_transaction_stage < 3 && $trade->seller_transaction_stage == 3 && $trade->ace_transaction_stage == 2))
                            <div class="text-center">
                                <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting for Traders to Settle Payment</strong>
                                <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="proceed">
                            </div>
                        @elseif($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 3 && $trade->ace_transaction_stage == 2)
                            <div class="text-center">
                                <strong class="text-success" id="info-1-text" style="font-size: 23px">Payment Settled, Proceed and Settle</strong>
                                <img width="100px" id="info-1-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
                            </div>
                        @endif
                        <p>Acknowledge Coin of <strong class="text-success">{{ $trade->coin_amount }} <span class="text-uppercase">{{ $trade->coin->abbr }}</span></strong>, once you receive the coin from <strong>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}</strong>. Please ensure that your coin is received before you proceed, as the transaction will continue between buyer and seller.</p>
                        <div class="text-center">
                            @if($trade->buyer_transaction_stage <= 2 && $trade->seller_transaction_stage <= 2 && $trade->ace_transaction_stage == 1)
                                <button id="step-1-proceed" class="btn btn-special p-2" type="button">I Have Received Coin</button>
                            @else
                                <button id="step-2-nav" class="btn btn-special py-2 px-4" type="button">Proceed</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function () {

            // StEP 1
            $(".step").on('click', '#step-1-proceed', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.enscrow.step2', $trade) }}",
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

            // STEP 2

            $(".step").on('click', '#step-2-proceed', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.enscrow.step3', $trade) }}",
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

            //NAVIGATIONS TAB-1

            $("#item-1-1-tab").click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.enscrow.nav.step1', $trade) }}",
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
                    url: "{{ route('admin.enscrow.nav.step2', $trade) }}",
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
                    url: "{{ route('admin.enscrow.nav.step3', $trade) }}",
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
        });

        @isset($trade)
        var channel = Echo.private('trade.{{ $trade->id }}');
        channel.listen('.coin-deposited', function() {
            $("#info-1-text").text('Coin Deposited, Verify Coin and Proceed');
            $("#info-1-text").removeClass('text-info');
            $("#info-1-text").addClass('text-success');
            $("#info-1-img").attr('src', '{{ asset('assets/img/proceed.gif') }}');
            $("#info-1-img").width('100');
        });

        channel.listen('.payment-verified', function() {
            $("#info-1-text").text('Payment Settled, Proceed and Settle');
            $("#info-1-text").removeClass('text-info');
            $("#info-1-text").addClass('text-success');
            $("#info-1-img").attr('src', '{{ asset('assets/img/proceed.gif') }}');
            $("#info-1-img").width('100');
        });

        @endisset
    </script>

@endsection

