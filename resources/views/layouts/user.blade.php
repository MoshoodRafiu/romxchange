<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ace World</title>
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body id="page-top"><nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav" style="background-color: rgb(2,12,31);">
    <div class="container"><a class="navbar-brand" href="{{ url('/') }}" style="font-family: Poppins, sans-serif;"><img src="{{asset('assets/img/logo.png?h=9a916f4afca54245be0a963ea50ede06')}}" width="40px"> ACE WORLD</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" data-toogle="collapse" aria-controls="navbarResponsive"
                                                                                                                                                                                                                   aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive" style="font-family: Poppins, sans-serif;">
            <ul class="nav navbar-nav ml-auto text-uppercase">
                <li role="presentation" class="nav-item"><a class=" {{ Request::is('/') ? "nav-link text-warning js-scroll-trigger" : "nav-link js-scroll-trigger" }} " href="{{ url('/') }}">Home</a></li>
{{--                <li role="presentation" class="nav-item"><a class="nav-link js-scroll-trigger" href="buy.html">BUY</a></li>--}}
{{--                <li role="presentation" class="nav-item"><a class="nav-link js-scroll-trigger" href="sell.html">SELL</a></li>--}}
                <li role="presentation" class="nav-item"><a class="{{ Request::is('market') ? "nav-link text-warning js-scroll-trigger" : "nav-link js-scroll-trigger" }}" href="{{ route('market.index') }}">MARKet</a></li>
                @guest
                    <li role="presentation" class="nav-item"><a class="{{ Request::is('login') ? "nav-link text-warning js-scroll-trigger" : "nav-link js-scroll-trigger" }}" href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                        <li role="presentation" class="nav-item"><a class="{{ Request::is('register') ? "nav-link text-warning js-scroll-trigger" : "nav-link js-scroll-trigger" }}" href="{{ route('register') }}">register</a></li>
                    @endif
                @else
                    <li class="nav-item dropdown"><a data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle nav-link" href="#">{{ Auth::user()->display_name }}</a>
                        <div role="menu" class="dropdown-menu border-warning" style="background-color: #04122f;color: #ffffff;">
                            <a class="{{ Request::is('profile') ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('profile.index') }}" style="  color: rgb(255,255,255);
" onmouseover="this.style.backgroundColor='#04122f';">PROFILE</a>
                            <a class="{{ Request::is('trades') ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('trade.index') }}" style="  color: rgb(255,255,255);" onmouseover="this.style.backgroundColor='#04122f';">TRADES</a>
                            <a class="{{ Request::is('verification') ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('verification.index') }}" style="  color: rgb(255,255,255);
  font-family: inherit;
" onmouseover="this.style.backgroundColor='#04122f';">VERIFICATION</a>
                            <a class="{{ Request::is('wallets') ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('wallet.index') }}" style="  color: rgb(255,255,255);
  font-family: inherit;
" onmouseover="this.style.backgroundColor='#04122f';">WALLETS</a>
                            <a class="{{ Request::is('market/user') ? "dropdown-item text-warning" : "dropdown-item" }}" href="{{ route('market.user') }}" style="  color: rgb(255,255,255);
  font-family: inherit;
" onmouseover="this.style.backgroundColor='#04122f';">MY ADVERTS</a>
                        </div>
                    </li>
                    <l1 role="presentation" class="nav-item"><a class="nav-link" href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">LOGOUT</a></l1>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
                <li role="presentation" class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div id="" style="min-height: 60vh">
    <div class="ajax-loader">
        <div class="loader"></div>
    </div>
    @yield('content')

</div>

<footer id="contact" class="company_footer">
    <div class="row">
        <div class="col-sm-6 col-md-4 footer-navigation">
            <h3><a href="#" style="font-family: Poppins, sans-serif;color: rgb(254,209,54);font-size: 28px;">ACE WORLD</a></h3>
            <p class="links"><a href="#">Home</a><strong> · </strong><a href="#">Buy</a><strong> · </strong><a href="#">Sell</a><strong> · </strong><a href="#">Market</a></p>
            <p class="company-name">ACE WORLD © 2020 </p>
        </div>
        <div class="col-sm-6 col-md-4 footer-contacts">
            <div><i class="fa fa-phone emphasis footer-contacts-icon"></i>
                <p class="footer-center-info email text-left"> +234 9099992234</p>
            </div>
            <div><i class="fa fa-phone emphasis footer-contacts-icon"></i>
                <p class="footer-center-info email text-left"> +234 7098897878</p>
            </div>
            <div><i class="fa fa-envelope emphasis footer-contacts-icon"></i>
                <p><a href="#" target="_blank">support@aceworld@gmail.com</a></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4 footer-about">
            <h4>About Us</h4>
            <p> <span class="emphasis">ACEWORLD</span> is an enscrowed online cryptocurrency peer-to-peer exchange platform that bridges the gap between cryptocurrency buyers and sellers at <span class="emphasis">zero risk.</span> </p>
            <div class="social-links social-icons"><a href="#"><i class="fa fa-facebook emphasis"></i></a><a href="#"><i class="fa fa-twitter emphasis"></i></a><a href="#"><i class="fa fa-instagram emphasis"></i></a><a href="#"><i class="fa fa-envelope emphasis"></i></a></div>
        </div>
    </div>
</footer>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>--}}
{{--<script src="{{asset('assets/js/script.min.js?h=cd034b0ef077cf81570ca19f43155272')}}"></script>--}}

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>--}}
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
{{--<script src="{{ asset('assets/js/script.min.js') }}"></script>--}}
@yield('script')
<script>
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
