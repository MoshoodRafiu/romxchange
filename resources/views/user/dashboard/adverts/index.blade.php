@extends('layouts.user')

@section('content')

    <section class="text-right bg-light pb-5" id="profile">
        <div class="container profile profile-view" id="profile">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-uppercase text-center section-heading" style="  font-size: 30px;">my adverts</h2>
                </div>
            </div>
            <div class="row">
                @if(Session::has('message'))
                    <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
                @elseif(Session::has('error'))
                    <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="ml-auto"><a href="{{ route('market.create') }}" class="btn btn-special d-flex align-items-center align-self-center">Create Advert<i class="fa mx-1 fa-plus-circle"></i></a></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-responsive-xl text-left" width="100%">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Coin</th>
                            <th>Type</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Rate</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($markets) > 0)
                            @foreach($markets as $key=>$market)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td class="text-capitalize">{{ $market->coin->name }}</td>
                                    @if($market->type === "buy")
                                        <td><strong class="text-success text-capitalize">{{ $market->type }} <i class="fas fa-arrow-circle-down text-success"></i></strong></td>
                                    @elseif($market->type === "sell")
                                        <td><strong class="text-danger text-capitalize">{{ $market->type }} <i class="fas fa-arrow-circle-up text-danger"></i></strong></td>
                                    @endif
                                    <td>{{ $market->min }}</td>
                                    <td>{{ $market->max }}</td>
                                    <td>{{ $market->rate }}</td>
                                    <td>
                                        <a href="{{ route('market.edit', $market) }}" class="btn btn-warning"><i class="fas fa-pencil-alt d-xl-flex justify-content-xl-center align-items-xl-center"></i></a>
                                        <button type="button" data-toggle="modal" data-target="#deleteModal{{ $market->id }}" class="btn btn-danger"><i class="far fa-trash-alt d-xl-flex justify-content-xl-center align-items-xl-center"></i></button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $market->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $market->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $market->id }}">Confirm</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete your <strong class="text-capitalize">{{ $market->coin->name }} <span class="@if($market->type === "buy") text-success @elseif($market->type === "sell") text-danger @endif">{{ $market->type }}</span></strong> advert?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <form method="post" action="{{ route('market.destroy', $market) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-success">Delete Advert</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>You have no advert</td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
