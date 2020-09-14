@extends('layouts.admin')
@section('content')

    <div>
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Analysis</h3>
        </div>
        <p>Filter analysis based on the preferred week</p>
        <form action="" method="get" id="filter-analysis">
            <select class="custom-select mb-4" name="week" id="week-of-year" style="margin: 5px 0;">
                <option value="">Select Week</option>
                @for($i = 1; $i < 53; $i++)
                    <option value="{{ $i }}" @isset($_GET['week']) @if($_GET['week'] == $i) selected @endif @else @if($currentWeek == $i) selected @endif @endisset>Week {{ $i }} @if($currentWeek == $i)(Current Week)@endif</option>
                @endfor
            </select>
            <select class="custom-select mb-4" name="year" id="year" style="margin: 5px 0;">
                <option value="">Select Year</option>
                @for($i = 2000; $i <= (int) date('Y', strtotime(now())); $i++)
                    <option value="{{ $i }}" @isset($_GET['year']) @if($_GET['year'] == $i) selected @endif @else @if((int) date('Y', strtotime(now())) == $i) selected @endif @endisset>{{ $i }} @if((int) date('Y', strtotime(now())) == $i)(Current Year)@endif</option>
                @endfor
            </select>
        </form>
        @isset($_GET['week'])
            @isset($_GET['year'])
                <p style="margin: 10px 0;font-size: 20px;">Showing Analysis For Week {{ $_GET['week'] }} of {{ $_GET['year'] }}</p>
            @endisset
        @endisset

        @php
            if(!(isset($_GET['week']) && (isset($_GET['year'])))){
                $thisWeekTrades = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->get();

                $thisWeekSuccessTradesMon = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'success')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 0')->count();
                $thisWeekSuccessTradesTue = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'success')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 1')->count();
                $thisWeekSuccessTradesWed = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'success')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 2')->count();
                $thisWeekSuccessTradesThu = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'success')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 3')->count();
                $thisWeekSuccessTradesFri = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'success')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 4')->count();
                $thisWeekSuccessTradesSat = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'success')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 5')->count();
                $thisWeekSuccessTradesSun = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'success')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 6')->count();

                $thisWeekPendingTradesMon = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'pending')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 0')->count();
                $thisWeekPendingTradesTue = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'pending')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 1')->count();
                $thisWeekPendingTradesWed = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'pending')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 2')->count();
                $thisWeekPendingTradesThu = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'pending')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 3')->count();
                $thisWeekPendingTradesFri = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'pending')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 4')->count();
                $thisWeekPendingTradesSat = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'pending')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 5')->count();
                $thisWeekPendingTradesSun = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'pending')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 6')->count();

                $thisWeekCancelledTradesMon = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'cancelled')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 0')->count();
                $thisWeekCancelledTradesTue = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'cancelled')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 1')->count();
                $thisWeekCancelledTradesWed = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'cancelled')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 2')->count();
                $thisWeekCancelledTradesThu = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'cancelled')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 3')->count();
                $thisWeekCancelledTradesFri = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'cancelled')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 4')->count();
                $thisWeekCancelledTradesSat = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'cancelled')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 5')->count();
                $thisWeekCancelledTradesSun = \App\Trade::whereYear('created_at', date('Y', strtotime(now())))->where('transaction_status', 'cancelled')->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->whereRaw('WEEKDAY(trades.created_at) = 6')->count();

            }else{
                $thisWeekTrades = \App\Trade::whereYear('created_at', $_GET['year'])->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->get();

                $thisWeekSuccessTradesMon = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'success')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 0')->count();
                $thisWeekSuccessTradesTue = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'success')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 1')->count();
                $thisWeekSuccessTradesWed = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'success')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 2')->count();
                $thisWeekSuccessTradesThu = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'success')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 3')->count();
                $thisWeekSuccessTradesFri = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'success')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 4')->count();
                $thisWeekSuccessTradesSat = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'success')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 5')->count();
                $thisWeekSuccessTradesSun = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'success')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 6')->count();

                $thisWeekPendingTradesMon = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'pending')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 0')->count();
                $thisWeekPendingTradesTue = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'pending')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 1')->count();
                $thisWeekPendingTradesWed = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'pending')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 2')->count();
                $thisWeekPendingTradesThu = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'pending')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 3')->count();
                $thisWeekPendingTradesFri = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'pending')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 4')->count();
                $thisWeekPendingTradesSat = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'pending')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 5')->count();
                $thisWeekPendingTradesSun = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'pending')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 6')->count();

                $thisWeekCancelledTradesMon = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'cancelled')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 0')->count();
                $thisWeekCancelledTradesTue = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'cancelled')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 1')->count();
                $thisWeekCancelledTradesWed = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'cancelled')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 2')->count();
                $thisWeekCancelledTradesThu = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'cancelled')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 3')->count();
                $thisWeekCancelledTradesFri = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'cancelled')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 4')->count();
                $thisWeekCancelledTradesSat = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'cancelled')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 5')->count();
                $thisWeekCancelledTradesSun = \App\Trade::whereYear('created_at', $_GET['year'])->where('transaction_status', 'cancelled')->whereRaw('WEEKOFYEAR(trades.created_at) = '.$_GET['week'])->whereRaw('WEEKDAY(trades.created_at) = 6')->count();
            }
        @endphp
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>weekly income</span></div>
                                <div class="text-dark font-weight-bold h5 mb-0"><span>${{ number_format($thisWeekTrades->where('transaction_status', 'success')->sum('transaction_charge_usd'), 2) }}</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>successful transactions</span></div>
                                <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $thisWeekTrades->where('transaction_status', 'success')->count() }}</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-exchange-alt fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-info py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>pending transactions</span></div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>{{ $thisWeekTrades->where('transaction_status', 'pending')->count() }}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto"><i class="far fa-hand-paper fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-warning py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>cancelled transactions</span></div>
                                <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $thisWeekTrades->where('transaction_status', 'cancelled')->count() }}</span></div>
                            </div>
                            <div class="col-auto"><i class="far fa-window-close fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary font-weight-bold m-0">Transaction Analysis</h6>
                        <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                            <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                                 role="menu">
                                <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a><a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <div class="chart-area"><canvas id="lineChart"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary font-weight-bold m-0">Transactions Breakdown</h6>
                        <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                            <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                                 role="menu">
                                <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a><a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="doughnutChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

        @section('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function () {
                    $('#week-of-year').change(function () {
                        $('#filter-analysis').submit();
                    })
                    $('#year').change(function () {
                        $('#filter-analysis').submit();
                    })
                })
                var lineChart = document.getElementById('lineChart');
                var newLineChart = new Chart(lineChart, {
                    type: 'line',
                    data: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        datasets: [
                            {
                                label: 'Success',
                                data: [{{ $thisWeekSuccessTradesMon }}, {{ $thisWeekSuccessTradesTue }}, {{ $thisWeekSuccessTradesWed }}, {{ $thisWeekSuccessTradesThu }}, {{ $thisWeekSuccessTradesFri }}, {{ $thisWeekSuccessTradesSat }}, {{ $thisWeekSuccessTradesSun }}],
                                borderWidth: 2,
                                borderColor: "#1cc88a",
                            },
                            {
                                label: 'Pending',
                                data: [{{ $thisWeekPendingTradesMon }}, {{ $thisWeekPendingTradesTue }}, {{ $thisWeekPendingTradesWed }}, {{ $thisWeekPendingTradesThu }}, {{ $thisWeekPendingTradesFri }}, {{ $thisWeekPendingTradesSat }}, {{ $thisWeekPendingTradesSun }}],
                                borderWidth: 2,
                                borderColor: "#f6c23e",
                            },
                            {
                                label: 'Cancelled',
                                data: [{{ $thisWeekCancelledTradesMon }}, {{ $thisWeekCancelledTradesTue }}, {{ $thisWeekCancelledTradesWed }}, {{ $thisWeekCancelledTradesThu }}, {{ $thisWeekCancelledTradesFri }}, {{ $thisWeekCancelledTradesSat }}, {{ $thisWeekCancelledTradesSun }}],
                                borderWidth: 2,
                                borderColor: "#e74a3b",
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

                var doughnutChart = document.getElementById('doughnutChart');
                var newDoughnutChart = new Chart(doughnutChart, {
                    type: 'doughnut',
                    data: {
                        datasets: [
                            {
                                data: [{{ $thisWeekTrades->where('transaction_status', 'success')->count() }}, {{ $thisWeekTrades->where('transaction_status', 'pending')->count() }}, {{ $thisWeekTrades->where('transaction_status', 'cancelled')->count() }}],
                                borderWidth: 2,
                                backgroundColor: ["#1cc88a", "#f6c23e", "#e74a3b"]
                            },
                        ],
                        labels: [
                            'Success',
                            'Pending',
                            'Cancelled'
                        ]
                    },
                });
            </script>
@endsection
