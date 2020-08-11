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
                            <div class="text-dark font-weight-bold h5 mb-0"><span>$40,000</span></div>
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
                            <div class="text-dark font-weight-bold h5 mb-0"><span>235</span></div>
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
                                    <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>13</span></div>
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
                            <div class="text-dark font-weight-bold h5 mb-0"><span>18</span></div>
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
                            <div class="text-dark font-weight-bold h5 mb-0"><span>43</span></div>
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
                            <div class="text-dark font-weight-bold h5 mb-0"><span>54</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-exchange-alt fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7 col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">This Week Transaction Analysis</h6>
                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                             role="menu">
                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a><a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Mon&quot;,&quot;Tue&quot;,&quot;Wed&quot;,&quot;Thu&quot;,&quot;Fri&quot;,&quot;Sat&quot;,&quot;Sun&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Transaction&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{&quot;display&quot;:false},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;3&quot;],&quot;zeroLineBorderDash&quot;:[&quot;3&quot;],&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;beginAtZero&quot;:false,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;3&quot;],&quot;zeroLineBorderDash&quot;:[&quot;3&quot;],&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;beginAtZero&quot;:false,&quot;padding&quot;:20}}]}}}"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">This Week Transactions Breakdown</h6>
                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                             role="menu">
                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a><a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Pending&quot;,&quot;Success&quot;,&quot;Cancelled&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#f6c23e&quot;,&quot;#1cc88a&quot;,&quot;#e74a3b&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;7&quot;,&quot;90&quot;,&quot;13&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;position&quot;:&quot;top&quot;},&quot;title&quot;:{&quot;display&quot;:false}}}"></canvas></div>
                    <div
                        class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-success"></i>&nbsp;Success</span><span class="mr-2"><i class="fas fa-circle text-warning"></i>&nbsp;Pending</span><span class="mr-2"><i class="fas fa-circle text-danger"></i>&nbsp;Cancelled</span>
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
                    <h4 class="small font-weight-bold">Completed Transactions<span class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="sr-only">80%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Pending Transactions<span class="float-right">5%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;"><span class="sr-only">5%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Cancelled Transaction<span class="float-right">15%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;"><span class="sr-only">15%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Account Verifications<span class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="sr-only">80%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Restricted Accounts<span class="float-right">100%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold m-0">Transacting Coins</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <h6 class="mb-0"><strong>Bitcoin</strong></h6><span class="text-xs">Updated 5 days ago by Admin&nbsp;</span></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <h6 class="mb-0"><strong>Litecoin</strong></h6><span class="text-xs">Updated 7 days ago by Admin</span></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <h6 class="mb-0"><strong>Ethereum</strong></h6><span class="text-xs">Updated 3 days ago by Admin</span></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="m-0">Bitcoin</p><img src="assets/img/ACE%20LOGO.png?h=263d8ee70ed3ee2b0397740431227328" width="30px"></div><p class="text-success font-weight-bold m-0" style="color: rgba(254,0,0,0.5);">Sold: 45 BTC</p><p class="text-danger font-weight-bold m-0">Bought: 45 BTC</p></div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="m-0">Ethereum</p><img src="assets/img/ACE%20LOGO.png?h=263d8ee70ed3ee2b0397740431227328" width="30px"></div><p class="text-success font-weight-bold m-0" style="color: rgba(254,0,0,0.5);">Sold: 45 ETH</p><p class="text-danger font-weight-bold m-0">Bought: 45 ETH</p></div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="m-0">Litecoin</p><img src="assets/img/ACE%20LOGO.png?h=263d8ee70ed3ee2b0397740431227328" width="30px"></div><p class="text-success font-weight-bold m-0" style="color: rgba(254,0,0,0.5);">Sold: 45 LTC</p><p class="text-danger font-weight-bold m-0">Bought: 45 LTC</p></div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="m-0">Ripple</p><img src="assets/img/ACE%20LOGO.png?h=263d8ee70ed3ee2b0397740431227328" width="30px"></div><p class="text-success font-weight-bold m-0" style="color: rgba(254,0,0,0.5);">Sold: 45 XPR</p><p class="text-danger font-weight-bold m-0">Bought: 45 XPR</p></div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="m-0">Tether</p><img src="assets/img/ACE%20LOGO.png?h=263d8ee70ed3ee2b0397740431227328" width="30px"></div><p class="text-success font-weight-bold m-0" style="color: rgba(254,0,0,0.5);">Sold: 45 THT</p><p class="text-danger font-weight-bold m-0">Bought: 45 THT</p></div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="m-0">Acecoin</p><img src="assets/img/ACE%20LOGO.png?h=263d8ee70ed3ee2b0397740431227328" width="30px"></div><p class="text-success font-weight-bold m-0" style="color: rgba(254,0,0,0.5);">Sold: 45 ACC</p><p class="text-danger font-weight-bold m-0">Bought: 45 ACC</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
