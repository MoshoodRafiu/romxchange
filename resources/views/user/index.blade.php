@extends('layouts.user')

@section('content')

    <header class="masthead" style="background-color: #04122f;">
        <div class="container">
            <div class="text-center intro-text">
                <div class="intro-lead-in">
                    <div class="row">
                        <div class="col-md-6 text-left d-flex align-items-center justify-content-center" style="font-style: normal;">
                            <div>
                                <h1>Buy and Sell your coin <span class="emphasis">at zero risk</span></h1>
                                <h6 class="font-weight-normal">The fastest and safest place to sell or buy your coin in less than 20 minutes</h6>
                            </div>
                        </div>
                        <div class="col-md-6"><img src="assets/img/bg.png?h=426e8e6e0a57f6c0b1fbf781b8f5fa78" class="img img-fluid"  /></div>
                    </div>
                </div>
                <div class="intro-heading text-uppercase"></div>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-danger btn-xl text-uppercase" href="{{ route('market.sell') }}" style="margin: 0 30px; z-index: 3;">SELL</a>
                    <a class="btn btn-success btn-xl text-uppercase" href="{{ route('market.buy') }}" style="margin: 0 30px; z-index: 3;">BUY</a>
                </div>
            </div>
        </div>
        <ul class="circles" style="z-index: 1;">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </header>
    <section id="services">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4"><span class="fa-stack fa-4x"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-bitcoin fa-stack-1x fa-inverse"></i></span>
                    <h4 class="section-heading">Buy Coins</h4>
                    <p class="text-muted">Buy any type of cryptocurrency from anybody, anywhere in the world, and receive your coins in less than 20 minutes at zero risk.</p>
                </div>
                <div class="col-md-4"><span class="fa-stack fa-4x"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-dollar fa-stack-1x fa-inverse"></i></span>
                    <h4 class="section-heading">Sell Coins</h4>
                    <p class="text-muted">Sell your cryptocurrencies at best rate to any verified vendor and get instant payment in less than 20 minutes.</p>
                </div>
                <div class="col-md-4"><span class="fa-stack fa-4x"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-bar-chart fa-stack-1x fa-inverse"></i></span>
                    <h4 class="section-heading">Crypto Market</h4>
                    <p class="text-muted">Get up-to-date market information and exchange rates of over 200 cryptocurrencies.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="portfolio" class="bg-light">
        <div class="container">
            <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="text-uppercase section-heading" style="font-size: 30px;">TOP Market</h2>
                    </div>
                    @if(Session::has('message'))
                        <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                    @elseif(Session::has('error'))
                        <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                    @endif
                    @if(Auth::user())
                        @if(!Auth::user()->verification)
                            <div class="alert col-12 alert-warning text-left" role="alert">You have to verify your account before making a trade</div>
                        @else()
                            @if(!Auth::user()->verification->is_email_verified || !Auth::user()->verification->is_phone_verified || !Auth::user()->verification->is_document_verified)
                                <div class="alert col-12 alert-warning text-left" role="alert">You have to verify your account before creating an advert</div>
                            @endif
                        @endif
                    @endif
                @if(count($markets) > 0)
                    @foreach($markets as $market)
                        <div class="col-10 col-sm-12 mx-auto bg-white d-md-block d-flex justify-content-between shadow py-md-4 border-left border-warning my-2">
                            <div class="d-md-flex justify-content-around">
                                <div><p>{{ $market->user->display_name }}</p></div>
                                @if($market->type === "buy")
                                    <div class="font-weight-bold">Buyer<i class="fa fa-arrow-circle-down text-success mx-1"></i></div>
                                @elseif($market->type === "sell")
                                    <div class="font-weight-bold">Seller<i class="fa fa-arrow-circle-up text-danger mx-1"></i></div>
                                @endif
                                <div><i class="fa fa-bitcoin text-warning"></i>{{ $market->min }}  -  {{ $market->max }} {{ $market->coin->name }}</div>
                                <div>NGN 4,745,345</div>
                                <div>
                                    <i class="fa fa-star rating text-warning"></i>
                                    <i class="fa fa-star rating text-warning"></i>
                                    <i class="fa fa-star rating text-warning"></i>
                                    <i class="fa fa-star rating text-warning"></i>
                                    <i class="fa fa-star rating text-secondary"></i>
                                </div>
                                @if($market->type === "buy")
                                    <a href="{{ route('trade.initiate.sell', $market) }}" class="btn btn-danger">Sell Now</a>
                                @elseif($market->type === "sell")
                                    <a href="{{ route('trade.initiate.buy', $market) }}" class="btn btn-success">Buy Now</a>
                                @endif
                            </div>
                            <div class="d-md-none d-block align-self-center">
                                @if($market->type === "buy")
                                    <a href="{{ route('trade.initiate.sell', $market) }}" class="btn btn-danger">Sell Now</a>
                                @elseif($market->type === "sell")
                                    <a href="{{ route('trade.initiate.buy', $market) }}" class="btn btn-success">Buy Now</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-10 col-sm-12 mx-auto bg-white d-md-block d-flex justify-content-between shadow py-md-4 border-left border-warning my-2">
                        No Market Available
                    </div>
                @endif
                </div>
        </div>
    </section>
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase" style="font-size: 30px;">Crypto market</h2><table id="example" class="table shadow table-responsive-sm" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Market Cap</th>
                            <th>USD</th>
                            <th>NGN</th>
                            <th>Change (24h) <i class="fa fa-exchange text-muted"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2</td>
                            <td>Bitcoin</td>
                            <td>$ 23,856,223,52</td>
                            <td>$9,700</td>
                            <td>NGN 4,453,634</td>
                            <td class="text-success">4.01%</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Bitcoin</td>
                            <td>$ 23,856,223,52</td>
                            <td>$9,700</td>
                            <td>NGN 4,453,634</td>
                            <td class="text-success">4.01%</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Bitcoin</td>
                            <td>$ 23,856,223,52</td>
                            <td>$9,700</td>
                            <td>NGN 4,453,634</td>
                            <td class="text-success">4.01%</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Bitcoin</td>
                            <td>$ 23,856,223,52</td>
                            <td>$9,700</td>
                            <td>NGN 4,453,634</td>
                            <td class="text-danger">4.01%</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Bitcoin</td>
                            <td>$ 23,856,223,52</td>
                            <td>$9,700</td>
                            <td>NGN 4,453,634</td>
                            <td class="text-success">4.01%</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Bitcoin</td>
                            <td>$ 23,856,223,52</td>
                            <td>$9,700</td>
                            <td>NGN 4,453,634</td>
                            <td class="text-success">4.01%</td>
                        </tr>
                        </tbody>
                    </table></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-group timeline"></ul>
                </div>
            </div>
        </div>
    </section><section id="testimonials">
        <div id="testimonial_095" class="carousel slide pb-5 testimonial_095_indicators testimonial_095_control_button thumb_scroll_x swipe_x ps_easeOutSine" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
            <div class="testimonial_095_header">
                <h5 class="emphasis">what people say</h5>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#testimonial_095" data-slide-to="0" class="active emphasis"></li>
                <li data-target="#testimonial_095" data-slide-to="1"></li>
                <li data-target="#testimonial_095" data-slide-to="2"></li>
                <li data-target="#testimonial_095" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="testimonial_095_slide"><a href="#"><span class="fa fa-user"></span></a>
                        <p>Lorem ipsum dolor sit amet <a href="#" class="emphasis">@consectetuer</a> adipiscing elit am nibh unc varius facilisis eros ed erat in in velit quis arcu ornare laoreet urabitur.</p>
                        <h5><a href="#" class="emphasis">Olakunle</a></h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial_095_slide"><a href="#"><span class="fa fa-user"></span></a>
                        <p>Lorem ipsum dolor sit amet <a href="#" class="emphasis">@consectetuer</a> adipiscing elit am nibh unc varius facilisis eros ed erat in in velit quis arcu ornare laoreet urabitur.</p>
                        <h5><a href="#" class="emphasis">Ayoola</a></h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial_095_slide"><a href="#"><span class="fa fa-user"></span></a>
                        <p>Lorem ipsum dolor sit amet <a href="#" class="emphasis">@consectetuer</a> adipiscing elit am nibh unc varius facilisis eros ed erat in in velit quis arcu ornare laoreet urabitur.</p>
                        <h5><a href="#" class="emphasis">Meezy</a></h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial_095_slide"><a href="#"><span class="fa fa-user"></span></a>
                        <p>Lorem ipsum dolor sit amet <a href="#" class="emphasis">@consectetuer</a> adipiscing elit am nibh unc varius facilisis eros ed erat in in velit quis arcu ornare laoreet urabitur.</p>
                        <h5><a href="#" class="emphasis">Bill Gates</a></h5>
                    </div>
                </div>
            </div><a class="carousel-control-prev btn-carousel" href="#testimonial_095" data-slide="prev"><span class="fa fa-chevron-left"></span></a><a class="carousel-control-next btn-carousel" href="#testimonial_095" data-slide="next"><span class="fa fa-chevron-right"></span></a></div>
    </section>

@endsection
