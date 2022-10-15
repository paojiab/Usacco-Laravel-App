<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\CheckWithdrawStatus;
use App\Models\SavingProduct;
use App\Models\SavingTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawController extends Controller
{
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'tel' => 'required|digits:10'
        ]);

        $amount = $request->amount;

        $tel = $request->tel;

        $key = \config('rave.key');

        $fees = Http::withHeaders([
            'Authorization' => $key
        ])->get('https://api.flutterwave.com/v3/transfers/fee?currency=UGX&type=mobilemoney&amount=' . $amount);

        $fee = $fees->object()->data[0]->fee;

        if ($fees->successful()) {

            $total = $fee + $amount;

            $account_id = auth()->user()->accounts()->first()->id;

            $type = auth()->user()->accounts()->first()->acct_type;

            $min_bal = SavingProduct::where('type', $type)->first()->minimum_balance;

            $balance = auth()->user()->accounts()->first()->account_balance;

            $actual_bal = $balance - $min_bal;

            if ($total > $actual_bal) {
                return redirect()->back()->with('status', 'Insufficient funds');
            } else {

                $response = Http::withHeaders([
                    'Authorization' => $key
                ])->post('https://api.flutterwave.com/v3/transfers', [
                    "account_bank" => "MPS",
                    "account_number" => $tel,
                    "amount" => $amount,
                    "currency" => "UGX",
                    "beneficiary_name" => "Paul Barasa",
                    "meta" => [
                        "sender" => "Usacco",
                        "sender_country" => "UG",
                        "mobile_number" => "2560760109642",
                    ]
                ]);

                $body = $response->object();

                if ($body->status == 'success') {

                    $id = $body->data->id;

                    return redirect()->route('withdraw.callback', [$id, $account_id]);
                } else {
                    return redirect('dashboard')->with('status', 'Unknown Error');
                }
            }
        } else {
            return redirect('dashboard')->with('status', 'Unexpected Error');
        }
    }

    public function callback(Request $request, $id, $account_id)
    {
        $key = \config('rave.key');

        $response = Http::withHeaders([
            'Authorization' => $key
        ])->get('https://api.flutterwave.com/v3/transfers/' . $id);

        $status = $response->object()->data->status;

        $amount = $response->object()->data->amount;

        $fee = $response->object()->data->fee;

        $ref = $response->object()->data->reference;

        $total = $amount + $fee;

        if($response->successful()) {

            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $account_id;
            $txn_data['txn_type'] = 'withdraw';
            $txn_data['reference'] = $ref;
            $txn_data['status'] = $status;
            $txn_data['fee'] = $fee;
            $txn_data['created_at'] = Carbon::now();

            $txn_id = SavingTransaction::insertGetId($txn_data);

            SavingTransaction::find($txn_id)->account()->decrement('account_balance', $total);

            $data = [
                'id' => $id, 
                'txn_id' => $txn_id,
                'key' => $key,
                'total' => $total
            ];

            CheckWithdrawStatus::dispatch($data)->delay(now()->addMinutes(10));

            return redirect('dashboard')->with('status', 'A new withdraw transaction has been initiated with reference code: ' . $ref);
        } 
         else {
            return redirect('dashboard')->with('status', 'Unexpected Error');
        }
    }
}
