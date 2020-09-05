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
