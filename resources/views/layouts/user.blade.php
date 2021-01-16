<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEOMeta::generate() !!}
    <link rel="icon" type="image/png" sizes="218x250" href="{{asset('assets/img/logo.png')}}">
{{--    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css?h=e3b2ea54c5d54884854fc0397d0f6bb8')}}">--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700">--}}
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">--}}
{{--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome5-overrides.min.css?h=2c0fc24b3d3038317dc51c05339856d0')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css?h=6db4afc03167ed9f14195623336d0742')}}">--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body id="page-top">
<nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav" style="background-color: rgb(2,12,31);">
    <div class="container"><a class="navbar-brand d-flex justify-content-center align-items-center" href="{{ url('/') }}" style="font-family: Poppins, sans-serif;"><img src="{{asset('assets/img/clogo.png')}}" id="brand-logo"></a><button id="toggleNavbar" class="navbar-toggler navbar-toggler-right" type="button"><i class="fa fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive" style="font-family: Poppins, sans-serif;">
            <ul class="nav navbar-nav ml-auto text-uppercase">
                <li role="presentation" class="nav-item"><a class=" {{ Request::is('/') ? "nav-link text-warning font-weight-bold js-scroll-trigger" : "nav-link font-weight-bold js-scroll-trigger" }} " href="{{ url('/') }}">Home</a></li>
{{--                <li role="presentation" class="nav-item"><a class="nav-link js-scroll-trigger" href="buy.html">BUY</a></li>--}}
{{--                <li role="presentation" class="nav-item"><a class="nav-link js-scroll-trigger" href="sell.html">SELL</a></li>--}}
                <li role="presentation" class="nav-item"><a class="{{ Request::routeIs(['market.index', 'market.filter', 'market.buy', 'market.sell']) ? "nav-link text-warning font-weight-bold js-scroll-trigger" : "nav-link font-weight-bold js-scroll-trigger" }}" href="{{ route('market.index') }}">MARKet</a></li>
                @guest
                    <li role="presentation" class="nav-item"><a class="{{ Request::is('login') ? "nav-link text-warning font-weight-bold js-scroll-trigger" : "nav-link font-weight-bold js-scroll-trigger" }}" href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                        <li role="presentation" class="nav-item"><a class="{{ Request::is('register') ? "nav-link font-weight-bold text-warning js-scroll-trigger" : "nav-link font-weight-bold js-scroll-trigger" }}" href="{{ route('register') }}">register</a></li>
                    @endif
                @else
                    @if(!(Auth::user()->is_admin == 1 || Auth::user()->is_agent == 1))
                    <li class="nav-item dropdown">
                        <a data-toggle="dropdown" aria-expanded="false" id="toggle" class="{{ Request::routeIs(['profile.index', 'trade.index', 'trade.accept.buy', 'trade.accept.sell', 'trade.initiate.buy', 'trade.initiate.sell', 'verification.index', 'verification.phone', 'verification.document', 'wallet.index', 'wallet.create', 'wallet.edit', 'market.user', 'market.create', 'market.edit']) ? "dropdown-toggle font-weight-bold nav-link text-warning" : "font-weight-bold dropdown-toggle nav-link" }}" href="#dropdown">{{ Auth::user()->display_name }}@if( \App\Trade::where('transaction_status', 'pending')->where(function ($query) {$query->where('buyer_id', Auth::user()->id)->orWhere('seller_id', Auth::user()->id);})->count() > 0)<span class="badge badge-danger mx-1 badge-counter small">{{ \App\Trade::where('transaction_status', 'pending')->where(function ($query) {$query->where('buyer_id', Auth::user()->id)->orWhere('seller_id', Auth::user()->id);})->count() }}</span>@endif</a>
                        <div role="menu" id="dropdown" class="dropdown-menu border-warning" style="background-color: #04122f;color: #ffffff;">
                            <a class="{{ Request::routeIs(['profile.index']) ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('profile.index') }}" style="color: rgb(255,255,255);" onmouseover="this.style.backgroundColor='#04122f';">PROFILE</a>
                            <a class="{{ Request::routeIs(['trade.index', 'trade.accept.buy', 'trade.accept.sell', 'trade.initiate.buy', 'trade.initiate.sell']) ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('trade.index') }}" style="  color: rgb(255,255,255);" onmouseover="this.style.backgroundColor='#04122f';">TRADES @if( \App\Trade::where('transaction_status', 'pending')->where(function ($query) {$query->where('buyer_id', Auth::user()->id)->orWhere('seller_id', Auth::user()->id);})->count() > 0)<span class="badge badge-danger mx-2 badge-counter small">{{ \App\Trade::where('transaction_status', 'pending')->where(function ($query) {$query->where('buyer_id', Auth::user()->id)->orWhere('seller_id', Auth::user()->id);})->count() }}</span>@endif</a>
                            <a class="{{ Request::routeIs(['verification.index', 'verification.phone', 'verification.document']) ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('verification.index') }}" style="  color: rgb(255,255,255);
  font-family: inherit;
" onmouseover="this.style.backgroundColor='#04122f';">VERIFICATION</a>
                            <a class="{{ Request::routeIs(['wallet.index', 'wallet.create', 'wallet.edit']) ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('wallet.index') }}" style="  color: rgb(255,255,255);
  font-family: inherit;
" onmouseover="this.style.backgroundColor='#04122f';">WALLETS</a>
                            <a class="{{ Request::routeIs(['market.user', 'market.create', 'market.edit']) ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('market.user') }}" style="  color: rgb(255,255,255);
  font-family: inherit;
" onmouseover="this.style.backgroundColor='#04122f';">MY ADVERTS</a>
                        </div>
                    </li>
                    @elseif(Auth::user()->is_admin == 1 && Auth::user()->is_agent == 1)
                        <li role="presentation" class="nav-item"><a class="nav-link font-weight-bold js-scroll-trigger" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @elseif(Auth::user()->is_admin == 0 && Auth::user()->is_agent == 1)
                        <li role="presentation" class="nav-item"><a class="nav-link font-weight-bold js-scroll-trigger" href="{{ route('admin.trades.disputes') }}">Dashboard</a></li>
                    @endif
                    <l1 role="presentation" class="nav-item"><a class="nav-link font-weight-bold" href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">LOGOUT</a></l1>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
                <li role="presentation" class="nav-item"><a class="nav-link font-weight-bold js-scroll-trigger" href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div id="app" style="min-height: 60vh">
    <div class="ajax-loader">
        <div class="loader"></div>
    </div>
    @yield('content')

</div>

<footer id="contact" class="company_footer">
    <div class="row">
        <div class="col-sm-6 col-md-4 footer-navigation">
            <h3><a href="#" style="font-family: Poppins, sans-serif;color: rgb(254,209,54);font-size: 20px;"><img src="{{asset('assets/img/clogo.png')}}" height="28px"></a></h3>
            <p class="links"><a href="{{ route('home') }}">Home</a><strong> · </strong><a href="{{ route('market.buy') }}">Buy</a><strong> · </strong><a href="{{ route('market.sell') }}">Sell</a><strong> · </strong><a href="{{ route('market.index') }}">Market</a></p>
            <p class="company-name">ROMXCHANGE © {{ date("Y", strtotime(now())) }} </p>
        </div>
        <div class="col-sm-6 col-md-4 footer-contacts">
            <div><i class="fa fa-phone small emphasis footer-contacts-icon"></i>
                <p class="small footer-center-info email text-left"><a href="tel:2348144259341"> +234 8144259341</a></p>
            </div>
            <div><i class="fa fa-envelope emphasis small footer-contacts-icon"></i>
                <p class="small footer-center-info email text-left"><a href="mailto:rafiumoshoodolakunle@gmail.com">rafiumoshoodolakunle@gmail.com</a></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4 footer-about">
            <h4>About Us</h4>
            <p> <span class="emphasis">ROMXCHANGE</span> is an escrow online cryptocurrency peer-to-peer exchange platform that bridges the gap between cryptocurrency buyers and sellers at <span class="emphasis">zero risk.</span> </p>
            <div class="social-links social-icons"><a href="#"><i class="fa fa-facebook emphasis"></i></a><a href="#"><i class="fa fa-twitter emphasis"></i></a><a href="#"><i class="fa fa-instagram emphasis"></i></a><a href="#"><i class="fa fa-envelope emphasis"></i></a></div>
        </div>
    </div>
</footer>
<script src="//code.tidio.co/c8xdi2r45imezsgn09lnyblgz9ep5w95.js" async></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="{{ asset('assets/js/script.min.js') }}"></script>
@yield('script')
<script>

    $('#toggle').click(function () {
        $('#dropdown').toggle();
    });

    $("#toggleNavbar").click(function (e) {
        e.preventDefault();
        $('#navbarResponsive').toggle(200);
    })

    function copyText(input) {
        /* Get the text field */
        var copyText = document.getElementById(input);

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");
        $("#" + input + "").siblings(".clipboard-message").fadeIn().delay(1000).fadeOut();
    }

</script>
</body>

</html>
