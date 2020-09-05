<?php

namespace App\Http\Controllers;

use App\Review;
use App\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'trade' => 'required',
            'star' => 'sometimes|numeric|between:0,5',
            'message'=> 'sometimes|string'
        ]);

        if ($validator->fails()){
            return redirect()->route('trade.index')->with('success', 'Trade Completed');
        }

        if ($request->star == null && $request->message == null){
            return redirect()->route('trade.index')->with('success', 'Trade Completed');
        }

        $trade = Trade::findOrFail($request->trade);

        if (Review::where('user_id', Auth::user()->id)->where('trade_id', $trade->id)->count() > 0){
            return redirect()->route('trade.index')->with('success', 'Trade Completed');
        }

        $review = new Review();

        $review->user_id = Auth::user()->id;
        $review->trade_id = $trade->id;
        $review->star = $request->star;
        $review->message = $request->message;

        $review->save();

        return redirect()->route('trade.index')->with('success', 'Trade Completed');
    }
}
