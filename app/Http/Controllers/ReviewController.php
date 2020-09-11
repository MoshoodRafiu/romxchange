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
        ]);

        if ($request->star > 5 || $request->star < 1){
            if (Auth::user()->is_admin == 0 && Auth::user()->is_agent == 0){
                return redirect()->route('trade.index')->with('success', 'Trade Completed');
            }else{
                return redirect()->route('admin.trades')->with('success', 'Trade Completed');
            }
        }

        if ($validator->fails()){
            if (Auth::user()->is_admin == 0 && Auth::user()->is_agent == 0){
                return redirect()->route('trade.index')->with('success', 'Trade Completed');
            }else{
                return redirect()->route('admin.trades')->with('success', 'Trade Completed');
            }
        }

        if ($request->star == null && $request->message == null){
            if (Auth::user()->is_admin == 0 && Auth::user()->is_agent == 0){
                return redirect()->route('trade.index')->with('success', 'Trade Completed');
            }else{
                return redirect()->route('admin.trades')->with('success', 'Trade Completed');
            }
        }

        $trade = Trade::findOrFail($request->trade);

        if (Review::where('user_id', Auth::user()->id)->where('trade_id', $trade->id)->count() > 0){
            if (Auth::user()->is_admin == 0 && Auth::user()->is_agent == 0){
                return redirect()->route('trade.index')->with('success', 'Trade Completed');
            }else{
                return redirect()->route('admin.trades')->with('success', 'Trade Completed');
            }
        }

        $review = new Review();

        $review->user_id = Auth::user()->id;
        $review->trade_id = $trade->id;
        $review->star = $request->star;
        $review->message = $request->message;

        $review->save();

        if (Auth::user()->is_admin == 0 && Auth::user()->is_agent == 0){
            return redirect()->route('trade.index')->with('success', 'Trade Completed');
        }else{
            return redirect()->route('admin.trades')->with('success', 'Trade Completed');
        }
    }
}
