<option value="">Select Wallet Company</option>
@foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $coin->id)->get() as $wallet)
    <option value="{{ $wallet->company }}">{{ $wallet->company }}</option>
@endforeach
<option value="others">Others</option>
