@extends('layouts.admin')

@section('content')

    <h3 class="text-dark mb-4">Disputes</h3>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert col-12 alert-success text-left" role="alert">{{ session('message') }}</div>
        @elseif(Session::has('error'))
            <div class="alert col-12 alert-danger text-left" role="alert">{{ session('error') }}</div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Transaction Details</p>
        </div>
        <div class="card-body row">
            <div class="form-group col-md-12">
                <label>Buyer</label>
                <div class="d-flex">
                    <input type="text" id="buyer" value="{{ $trade->transaction_id }}" class="form-control" readonly>
                    <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                    <a class="btn btn-secondary text-white" onclick="copyText('buyer')"><i class="fas fa-copy mx-1"></i></a>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Buyer</label>
                <div class="d-flex">
                    <input type="text" id="buyer" value="{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}" class="form-control" readonly>
                    <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                    <a class="btn btn-secondary text-white" onclick="copyText('buyer')"><i class="fas fa-copy mx-1"></i></a>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Seller</label>
                <div class="d-flex">
                    <input type="text" id="seller" value="{{ \App\User::whereId($trade->seller_id)->first()->display_name }}" class="form-control" readonly>
                    <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                    <a class="btn btn-secondary text-white" onclick="copyText('seller')"><i class="fas fa-copy mx-1"></i></a>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Coin Amount</label>
                <div class="d-flex">
                    <input type="text" id="amount" value="{{ $trade->coin_amount }} {{ $trade->coin->abbr }}" class="form-control" readonly>
                    <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                    <a class="btn btn-secondary text-white" onclick="copyText('amount')"><i class="fas fa-copy mx-1"></i></a>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Coin Amount NGN</label>
                <div class="d-flex">
                    <input type="text" id="ngn" value="{{ number_format($trade->coin_amount_ngn, 2) }}" class="form-control" readonly>
                    <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
                    <a class="btn btn-secondary text-white" onclick="copyText('ngn')"><i class="fas fa-copy mx-1"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5">
        <div class="card-header bg-special text-warning">
            <h6>Dispute Chat Box</h6>
        </div>
        <div class="card-body chat-field">
            @foreach($trade->messages as $message)
                @if($message->type == "text")
                    <div class="@if($message->user->id == Auth::user()->id) sent @else received @endif">
                        <span class="owner">@if($message->user->id == Auth::user()->id) You @else {{ $message->user->display_name }} @endif</span>
                        <span>{{ $message->message }}</span>
                        <span class="time">{{ date('h:i A', strtotime($message->created_at)) }}</span>
                    </div>
                @elseif($message->type == "image")
                    <div class="@if($message->user->id == Auth::user()->id) sent @else received @endif">
                        <span class="owner">@if($message->user->id == Auth::user()->id) You @else {{ $message->user->display_name }} @endif</span>
                        <div class="text-center"><img class="img img-fluid p-3" src="{{ asset('/proofs/'.$message->message) }}" alt="img"></div>
                        <span class="time">{{ date('h:i A', strtotime($message->created_at)) }}</span>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="card-footer bg-special p-2">
            <div class="mb-4">
                <div>
                    <textarea name="message" id="message" class="form-control"  @if($trade->is_special  == 1) disabled @endif></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    @if($trade->is_special  == 1)
                        <button type="button" class="my-2 btn btn-info" disabled>Upload Payment Proof</button>
                    @else
                        <form id="payment-proof-form" class="text-center my-2" action="{{ route('message.file.send') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="trade" value="{{ $trade->id }}">
                            <input type="file" id="payment-proof-file" name="file" style="display:none;"/>
                            <button type="button" id="payment-proof-button" class="btn btn-info">Upload Payment Proof</button>
                        </form>
                    @endif
                    @if($trade->is_special  == 1)
                            <button disabled class="mx-2 btn btn-success my-2">Send Message</button>
                    @else
                        <button id="send-message" class="mx-2 btn btn-success my-2">Send Message</button>
                    @endif
                </div>
                <hr class="bg-white">
                <div class="text-center mt-3">
                    @if($trade->is_special  == 1)
                        <a href="{{ route('admin.trades.disputes') }}" class="btn px-4 btn-secondary">Leave Chat</a>
                    @else
                        <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn px-4 btn-danger">Cancel Trade</button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel">Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to cancel this trade?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="get" action="{{ route('trade.switch', $trade) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cancel Trade</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

        $(".chat-field").animate({ scrollTop: 999999 }, 1000);

        $("#send-message").click(function (e) {
            e.preventDefault();
            sendMessage();
        });

        var sendMessage = function () {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.message.send') }}",
                method: "POST",
                data: {
                    trade: {{ $trade->id }},
                    message: $('#message').val(),
                },
                cache: false,
                beforeSend: function () {
                    $(".ajax-loader").show();
                },
                complete: function () {
                    $(".ajax-loader").hide();
                },
                success: function (result) {
                    if (result.success) {
                        $(".chat-field").fadeIn().html(result.html);
                        $(".chat-field").animate({ scrollTop: 999999 }, 1000);
                        $('#message').val("");
                        // document.querySelector('.chat-field').scrollTo({ left: 0, top: document.body.scrollHeight});
                    }
                }
            });
        }

        var channel = Echo.private('trade.{{ $trade->id }}');

        channel.listen('.message-sent', function(data) {

            if(data.id !== {{ \Illuminate\Support\Facades\Auth::user()->id }}){
                const div = document.createElement('div');

                if(data.sender === "agent"){
                    div.className = 'agent';
                }else {
                    div.className = 'received';
                }

                if(data.type === "text"){
                    div.innerHTML = `
                    <span class="owner">${data.sender}</span>
                    <span>${data.message}</span>
                    <span class="time">${data.time}</span>`;
                }else{
                    var getUrl = window.location;
                    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[0];
                    var imgUrl = baseUrl+'proofs/'+data.message
                    div.innerHTML = `
                    <span class="owner">${data.sender}</span>
                    <div class="text-center"><img class="img img-fluid p-3" src="${imgUrl}" alt="img"></div>
                    <span class="time">${data.time}</span>`;
                }

                document.querySelector('.chat-field').appendChild(div);
                $(".chat-field").animate({ scrollTop: 999999 }, 1000);
            }
        });

    </script>

@endsection

