<h4 class="text-center my-4">Step 5</h4>
<div class="form-group" style="width: 100%;">
    <div class="form-group">
        <div class="text-center star-rating" style="  font-size: 25px;
                        color: #f9dd16;
                        "><span class="fa fa-2x fa-star-o" style="  padding-right: 1px;
                        padding-left: 1px;
                        " data-rating="1"></span><span class="fa fa-star-o fa-2x" style="  padding-right: 1px;
                        padding-left: 1px;
                        " data-rating="2"></span><span class="fa fa-star-o fa-2x" style="  padding-right: 1px;
                        padding-left: 1px;
                        " data-rating="3"></span><span class="fa fa-star-o fa-2x" style="  padding-right: 1px;
                        padding-left: 1px;
                        " data-rating="4"></span><span class="fa fa-2x fa-star-o" style="  padding-right: 1px;
                        padding-left: 1px;
                        " data-rating="5"></span><input class="form-control rating-value" type="hidden" id="rate" name="Rating" value="0" />
        </div>
    </div>
    <p>Transaction completed, the held <strong class="text-info">{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</strong> has been released to <strong>{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}</strong> . Please rate your transaction with <strong>{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}</strong> based on transaction time of completion</p>
    <form action="{{ route('review.store') }}" method="post">
        @csrf
        <input type="hidden" name="trade" value="{{ $trade->id }}">
        <input type="hidden" name="star" id="star-rating">
        <div class="form-group col-12">
            <textarea name="message" id="review" class="form-control" placeholder="Review"></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-special p-2">Submit Review & Rating</button>
        </div>
    </form>
    <div class="text-center">
        <a class="btn btn-success p-2" href="{{ route('trade.index') }}">Skip & Finish</a>
    </div>
</div>
