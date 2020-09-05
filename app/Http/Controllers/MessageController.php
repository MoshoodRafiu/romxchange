<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Trade;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class MessageController extends Controller
{
    public function sendRegular(Request $request){
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'trade' => 'required'
        ]);

        if ($validator->fails()){
            return back();
        }

        $trade = Trade::find($request->trade);

        if (Auth::user()->id === $trade->buyer_id){

            if ($request->message == "1"){
                $text = "Hello";
            }elseif ($request->message == "2"){
                $text = "Payment made";
            }elseif ($request->message == "3"){
                $text = "Confirm payment";
            }elseif ($request->message == "4"){
                $text = "I have sent payment proof";
            }else{
                return back();
            }

        }elseif (Auth::user()->id === $trade->seller_id){

            if ($request->message == "1"){
                $text = "Hello";
            }elseif ($request->message == "2"){
                $text = "Payment not complete";
            }elseif ($request->message == "3"){
                $text = "Make payment";
            }elseif ($request->message == "4"){
                $text = "Send payment proof";
            }else{
                return back();
            }

        }

        $message = new Message();

        $message->trade_id = $trade->id;
        $message->user_id = Auth::user()->id;
        $message->message = $text;
        $message->type = "text";

        $message->save();

        event(new MessageSent($trade, $message));

        if (Auth::user()->id === $trade->buyer_id){
            $html = view('user.dashboard.trades.initiate.partials.buy.chat', compact('trade'))->render();
        }elseif(Auth::user()->id === $trade->seller_id){
            $html = view('user.dashboard.trades.accept.partials.sell.chat', compact('trade'))->render();
        }

        return response()->json(array('success' => true, 'html' => $html));

    }

    public function sendAdmin(Request $request){
        if(Auth::user()->is_admin == 0 && Auth::user()->is_agent == 0){
            return back();
        }

        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'trade' => 'required'
        ]);

        if ($validator->fails()){
            return back();
        }

        $trade = Trade::find($request->trade);


        $message = new Message();

        $message->trade_id = $trade->id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->type = "text";

        $message->save();

        event(new MessageSent($trade, $message));

        $html = view('admin.trades.disputes.partials.messages', compact('trade'))->render();


        return response()->json(array('success' => true, 'html' => $html));
    }

    public function sendRegularFile(Request $request){
        $validator = Validator::make($request->all(), [
            "trade" => "required",
            "file" => "required|mimes:jpg,png,jpeg"
        ]);

        if ($validator->fails()){
            return back();
        }

        $file = $request->file;

        $file_name = time().'-'.$file->getClientOriginalName();

        $destinationPath = 'proofs/'.$file_name;

        Image::make($file->getRealPath())->resize(200, 300)->save($destinationPath);

        $trade = Trade::find($request->trade);

        $message = new Message();

        $message->trade_id = $trade->id;
        $message->user_id = Auth::user()->id;
        $message->message = $file_name;
        $message->type = "image";

        $message->save();

        event(new MessageSent($trade, $message));

        $html = view('user.dashboard.trades.accept.partials.sell.chat', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }
}
