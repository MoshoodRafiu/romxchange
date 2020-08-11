<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ace World</title>
    <link rel="icon" type="image/png" sizes="218x250" href="{{asset('assets/img/logo.png')}}">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sidebar-assets/css/styles.min.css') }}">
    <link href="{{ asset('sidebar-assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion sidebar p-0" style="background-color: rgb(1,7,24);">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.html">
                <div><img src="{{ asset('sidebar-assets/img/ACE%20LOGO.png') }}" width="40px"></div>
                <div class="sidebar-brand-text mx-3"><span style="font-size: 20px;">ACE WORLD</span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt" style="width: 20px"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('admin.markets') }}"><i class="fas fa-store" style="width: 20px"></i><span>Market</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('admin.transactions') }}"><i class="fas fa-dollar-sign" style="width: 17px"></i><span>Transactions</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('admin.customers') }}"><i class="fas fa-users" style="width: 20px"></i><span>Customers</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="verifications.html"><i class="fas fa-file-alt" style="width: 20px"></i><span>Verifications</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="encrow.html"><i class="far fa-credit-card" style="width: 20px"></i><span>Enscrow</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="agents.html"><i class="fas fa-user-friends" style="width: 20px"></i><span>Agents</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="trades.html"><i class="fas fa-exchange-alt" style="width: 20px"></i><span>Trades</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <div>
                        <a class="btn btn-link nav-link" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-1" href="#collapse-1" role="button">
                            <i class="fas fa-wallet"  style="width: 20px"></i>&nbsp;<span>Wallets</span>
                        </a>
                        <div class="collapse" id="collapse-1">
                            <div class="bg-white border rounded py-2 collapse-inner">
                                <h6 class="collapse-header">wallets:</h6>
                                <a class="collapse-item" href="wallets.html">All&nbsp;</a>
                                <a class="collapse-item" href="bitcoin-wallets.html">Bitcoin</a>
                                <a class="collapse-item" href="ethereum-wallets.html">Ethereum</a>
                                <a class="collapse-item" href="litecoin-wallets.html">Litecoin</a>
                                <a class="collapse-item" href="tether-wallets.html">Tether</a>
                                <a class="collapse-item" href="ripple-wallets.html">Ripple</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="analysis.html"><i class="fas fa-chart-bar"  style="width: 20px"></i><span>Analysis</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="settings.html"><i class="fas fa-cog"  style="width: 20px"></i><span>Settings</span></a>
                </li>
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
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                    <i class="fas fa-exchange-alt fa-fw"></i><span class="badge badge-danger badge-counter">7</span>
                                </a>
                            </div>
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                    <span class="d-none d-lg-inline mr-2 text-gray-600 small">Aministrator</span>
                                    <img class="border rounded-circle img-profile" src="{{ asset('sidebar-assets/img/avatars/avatar1.jpeg') }}"></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                    <a class="dropdown-item" role="presentation" href="profile.html"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                    <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © ACE WORLD 2020</span></div>
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
</body>

</html>
