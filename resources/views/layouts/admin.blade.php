<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AcexWorld</title>
    <link rel="icon" type="image/png" sizes="218x250" href="{{asset('assets/img/logo.png')}}">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/css/styles.min.css') }}">
    <link href="{{ asset('sidebar-assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body id="page-top">
<div class="ajax-loader">
    <div class="loader"></div>
</div>
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion sidebar p-0" style="background-color: rgb(1,7,24);">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('admin.dashboard') }}">
                <div><img src="{{ asset('assets/img/logo.png') }}" width="37px"></div>
                <div class="sidebar-brand-text mx-3"><span style="font-size: 20px;"><img src="{{ asset('assets/img/name.png') }}" class="img img-fluid" alt="brand"></span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::is('admin/dashboard') ? "nav-link active" : "nav-link" }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt" style="width: 30px; text-align: center;"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.markets', 'admin.markets.filter', 'admin.markets.create', 'admin.markets.edit']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.markets') }}"><i class="fas fa-store" style="width: 30px; text-align: center;"></i><span>Market</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.transactions', 'admin.transactions.filter']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.transactions') }}"><i class="fas fa-dollar-sign" style="width: 30px; text-align: center;"></i><span>Transactions</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.customers','admin.customers.filter', 'admin.customers.show']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.customers') }}"><i class="fas fa-users" style="width: 30px; text-align: center;"></i><span>Customers</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.verifications', 'admin.verifications.show']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.verifications') }}"><i class="fas fa-file-alt" style="width: 30px; text-align: center;"></i>@if(\App\Verification::where('document_verification_status', 'pending')->count() > 0)<span class="badge badge-danger py-1 m-0 mx-md-2 px-2 badge-counter">{{ \App\Verification::where('document_verification_status', 'pending')->count() }}</span>@endif<span>Verifications</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.transactions.enscrow', 'admin.transactions.accept', 'admin.transactions.proceed']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.transactions.enscrow') }}"><i class="far fa-credit-card" style="width: 30px; text-align: center;"></i>@if(\App\Trade::where('is_special', 0)->where('transaction_status', 'pending')->count() > 0)<span class="badge badge-danger py-1 m-0 mx-md-2 px-2 badge-counter">{{ \App\Trade::where('is_special', 0)->where('transaction_status', 'pending')->count() }}</span>@endif<span>Enscrow</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.agents', 'admin.agents.create']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.agents') }}"><i class="fas fa-user-friends" style="width: 30px; text-align: center;"></i><span>Agents</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.trades', 'admin.trade.accept.buy', 'admin.trade.accept.sell']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.trades') }}"><i class="fas fa-exchange-alt" style="width: 30px; text-align: center;"></i>@if(\App\Trade::where('is_special', 1)->where('transaction_status', 'pending')->count() > 0)<span class="badge badge-danger py-1 m-0 mx-md-2 px-2 badge-counter">{{ \App\Trade::where('is_special', 1)->where('transaction_status', 'pending')->count() }}</span>@endif<span>Trades</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.trades.disputes', 'admin.trades.dispute.join']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.trades.disputes') }}"><i class="fas fa-exclamation-triangle" style="width: 30px; text-align: center;"></i>@if(\App\Trade::where('is_special', 0)->where('is_dispute', 1)->where('transaction_status', 'pending')->count() > 0)<span class="badge badge-danger py-1 m-0 mx-md-2 px-2 badge-counter">{{ \App\Trade::where('is_special', 0)->where('is_dispute', 1)->where('transaction_status', 'pending')->count() }}</span>@endif<span>Disputes</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <div>
                        <a class="btn btn-link nav-link {{ Request::routeIs(['admin.wallets.all','admin.wallets.single']) ? "active" : "" }}" id="walletsToggleButton">
                            <i class="fas fa-wallet"  style="width: 30px; text-align: center;"></i>&nbsp;<span>Wallets</span>
                        </a>
                        <div class="collapse" id="collapse-1">
                            <div class="bg-white border rounded py-2 collapse-inner">
                                <h6 class="collapse-header">wallets:</h6>
                                <a class="collapse-item" href="{{ route('admin.wallets.all') }}">All&nbsp;</a>
                                @foreach(\App\Coin::all() as $coin)
                                    <a class="collapse-item text-capitalize" href="{{ route('admin.wallets.single', $coin->name) }}">{{ $coin->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.analysis']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.analysis') }}"><i class="fas fa-chart-bar"  style="width: 30px; text-align: center;"></i><span>Analysis</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.profile']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.profile') }}"><i class="fas fa-user"  style="width: 30px; text-align: center;"></i><span>Profile</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="{{ Request::routeIs(['admin.settings']) ? "nav-link active" : "nav-link" }}" href="{{ route('admin.settings') }}"><i class="fas fa-cog"  style="width: 30px; text-align: center;"></i><span>Settings</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-globe"  style="width: 30px; text-align: center;"></i><span>Website</span></a>
                </li>
                <l1 role="presentation" class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"  style="width: 30px; text-align: center;"></i><span>Logout</span></a></l1>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link text-secondary d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                            <div class="input-group-append"><button class="btn btn-special py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </div>
                    </form>
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                            <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto navbar-search w-100">
                                    <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                        <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                            <div class="nav-item dropdown no-arrow">
                                <div class="d-flex">
                                    <a class="dropdown-toggle nav-link" href="{{ route('admin.trades') }}">
                                        <i class="fas fa-exchange-alt fa-fw"></i>@if(\App\Trade::where('is_special', 1)->where('transaction_status', 'pending')->count() > 0)<span class="badge badge-danger badge-counter">{{ \App\Trade::where('is_special', 1)->where('transaction_status', 'pending')->count() }}</span>@endif
                                    </a>
                                    <a class="dropdown-toggle nav-link" href="{{ route('admin.transactions.enscrow') }}">
                                        <i class="fas fa-credit-card fa-fw"></i>@if(\App\Trade::where('is_special', 0)->where('transaction_status', 'pending')->count() > 0)<span class="badge badge-danger badge-counter">{{ \App\Trade::where('is_special', 0)->where('transaction_status', 'pending')->count() }}</span>@endif
                                    </a>
                                    <a class="dropdown-toggle nav-link" href="{{ route('admin.trades.disputes') }}">
                                        <i class="fas fa-exclamation-triangle fa-fw"></i>@if(\App\Trade::where('is_special', 0)->where('is_dispute', 1)->where('transaction_status', 'pending')->count() > 0)<span class="badge badge-danger badge-counter">{{ \App\Trade::where('is_special', 0)->where('is_dispute', 1)->where('transaction_status', 'pending')->count() }}</span>@endif
                                    </a>
                                </div>
                            </div>
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                    <span class="d-none d-lg-inline mr-2 text-gray-600 small">{{ Auth::user()->display_name }}</span>
                                    <img class="border rounded-circle img-profile" src="{{ asset('sidebar-assets/img/avatars/avatar.jpg') }}">
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                    <a class="dropdown-item" role="presentation" href="profile.html"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                    <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="p-md-4 p-3">

                @yield('content')

            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © ACE WORLD {{ date("Y", strtotime(now())) }}</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<script src="{{ asset('sidebar-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('sidebar-assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('sidebar-assets/js/chart.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{ asset('sidebar-assets/js/script.min.js') }}"></script>
<script src="{{ asset('sidebar-assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sidebar-assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('sidebar-assets/js/datatables.js') }}"></script>
@yield('script')
<script>
    $(document).ready(function () {
        $('#walletsToggleButton').click(function (e) {
            e.preventDefault();
            $('#collapse-1').toggle('slow')
        })
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
