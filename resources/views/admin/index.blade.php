@extends('layouts.admin')

@section('content')

    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Dashboard</h3>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>total income</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>USD {{ $trades->count() == 0 ? 0 : number_format($trades->where('transaction_status', 'success')->sum('transaction_charge_usd'), 2) }}</span></div>
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
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $trades->count() == 0 ? 0 : number_format($trades->where('transaction_status', 'success')->count()) }}</span></div>
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
                                    <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>{{ $trades->count() == 0 ? 0 : number_format($trades->where('transaction_status', 'pending')->count()) }}</span></div>
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
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $trades->count() == 0 ? 0 : number_format($trades->where('transaction_status', 'cancelled')->count()) }}</span></div>
                        </div>
                        <div class="col-auto"><i class="far fa-window-close fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Yesterday transactions</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $trades->count() == 0 ? 0 : number_format(\App\Trade::whereDate('created_at', \Carbon\Carbon::yesterday())->count()) }}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-exchange-alt fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>today's transaction</span></div>
                            <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $trades->count() == 0 ? 0 : number_format(\App\Trade::whereDate('created_at', \Carbon\Carbon::today())->count()) }}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-exchange-alt fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">This Week Transaction Analysis</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="lineChart"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">This Week Transactions Breakdown</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold m-0">Evaluations</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Successful Transactions<span class="float-right">{{$trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'success')->count() / $trades->count()) * 100, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" aria-valuenow="{{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'success')->count() / $trades->count()) * 100, 1) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'success')->count() / $trades->count()) * 100, 1) }}%;"><span class="sr-only">{{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'success')->count() / $trades->count()) * 100, 1) }}%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Pending Transactions<span class="float-right">{{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'pending')->count() / $trades->count()) * 100, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" aria-valuenow="{{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'pending')->count() / $trades->count()) * 100, 1) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'pending')->count() / $trades->count()) * 100, 1) }}%;"><span class="sr-only">{{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'pending')->count() / $trades->count()) * 100, 1) }}%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Cancelled Transaction<span class="float-right">{{  $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'cancelled')->count() / $trades->count()) * 100, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" aria-valuenow="{{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'cancelled')->count() / $trades->count()) * 100, 1) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'cancelled')->count() / $trades->count()) * 100, 1) }}%;"><span class="sr-only">{{ $trades->count() == 0 ? 0 : round(($trades->where('transaction_status', 'cancelled')->count() / $trades->count()) * 100, 1) }}%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Email Verifications<span class="float-right">{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_email_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" aria-valuenow="{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_email_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_email_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%;"><span class="sr-only">{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_email_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Phone Verifications<span class="float-right">{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_phone_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" aria-valuenow="{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_phone_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_phone_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%;"><span class="sr-only">{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_phone_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Document Verifications<span class="float-right">{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_document_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" aria-valuenow="{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_document_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_document_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%;"><span class="sr-only">{{ $trades->count() == 0 ? 0 : round((\App\Verification::where('is_document_verified', 1)->count() / \App\User::all()->count()) * 100, 1) }}%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Restricted Accounts<span class="float-right">{{ $trades->count() == 0 ? 0 : round((\App\User::where('is_admin', 0)->where('is_agent', 0)->where('is_active', 0)->count() / \App\User::where('is_admin', 0)->where('is_agent', 0)->count()) * 100, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" aria-valuenow="{{ $trades->count() == 0 ? 0 : round((\App\User::where('is_admin', 0)->where('is_agent', 0)->where('is_active', 0)->count() / \App\User::where('is_admin', 0)->where('is_agent', 0)->count()) * 100, 1) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trades->count() == 0 ? 0 : round((\App\User::where('is_admin', 0)->where('is_agent', 0)->where('is_active', 0)->count() / \App\User::where('is_admin', 0)->where('is_agent', 0)->count()) * 100, 1) }}%;"><span class="sr-only">{{ $trades->count() == 0 ? 0 : round((\App\User::where('is_admin', 0)->where('is_agent', 0)->where('is_active', 0)->count() / \App\User::where('is_admin', 0)->where('is_agent', 0)->count()) * 100, 1) }}%</span></div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold m-0">Transacting Coins</h6>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($coins as $coin)
                        <li class="list-group-item">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <h6 class="mb-0 text-capitalize"><strong>{{ $coin->name }}</strong></h6>
                                    <span class="text-xs">Updated {{ $coin->created_at->diffForHumans() }} ago by Admin&nbsp;</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="row">
                @foreach($coins as $coin)
                    <div class="col-md-6 mb-4">
                        <div class="card bg-white shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0 text-capitalize"><strong>{{ $coin->name }}</strong></p>
                                    <img src="{{ asset('/images/'.$coin->logo) }}" height="30px">
                                </div>
                                <p class="text-success m-0" style="color: rgba(254,0,0,0.5);">Traded: {{ \App\Trade::where('coin_id', $coin->id)->where('transaction_status', 'success')->sum('coin_amount') }} {{ $coin->abbr }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
    <script>
        @php
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
        @endphp
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
