@isset($trade)
<div class="card">
    <div class="card-header bg-special text-warning">
        <h6>Dispute Chat Box</h6>
    </div>
    <div class="card-body chat-field">
        <div class="chat-info">This chat is strictly for trade disputes, any information not relating to this trade should not be shared</div>
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
    <div class="card-footer bg-special">
        <div class="messages-area text-center">
            <span class="message" id="message-1">Hello</span>
            <span class="message" id="message-2">Payment not complete</span>
            <span class="message" id="message-3">Make payment</span>
            <span class="message" id="message-4">Send payment proof</span>
        </div>
        <form id="payment-proof-form" class="text-center my-2" action="{{ route('message.file.send') }}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" name="trade" value="{{ $trade->id }}">
            <input type="file" id="payment-proof-file" name="file" style="display:none;"/>
            <button type="button" id="payment-proof-button" class="btn btn-info">Upload Payment Proof</button>
        </form>
    </div>
</div>
@endisset
