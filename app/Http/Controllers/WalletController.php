<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use App\Notifications\DepositNotification;
use Illuminate\Support\Facades\Http;
use App\Jobs\CheckWithdrawStatus;
use Carbon\Carbon;

class WalletController extends Controller
{
    public function index(){
        $balance = auth()->user()->wallet;
        $txns = auth()->user()->walletTransactions()->latest()->paginate(10);
        return view('usacco.wallet',compact('balance','txns'));
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);

        $amount = $request->amount;

        $tx_ref = '90' . mt_rand(100000000, 999999999);

        $email = auth()->user()->email;

        $name = auth()->user()->name;

        $key = \config('rave.key');

        $response = Http::withHeaders([
            'Authorization' =>  $key
        ])->post('https://api.flutterwave.com/v3/payments', [
            'tx_ref' => $tx_ref,
            'amount' => $amount,
            'currency' => 'UGX',
            'redirect_url' => route('wallet.deposit.callback'),
            'customer' => [
                'name' => $name,
                'email' => $email
            ],
            'customizations' => [
                'title' => 'Usacco',
                'description' => 'Wallet Deposit',
            ]
        ]);

        if ($response->successful()) {

            $body = $response->object();

            if ($body->status == 'success') {

                $link = $body->data->link;


                return redirect($link);
            } else {
                return redirect()->route('wallet')->with('status', $body->message);
            }
        } else {
            return redirect()->route('wallet')->with('status', 'Unexpected Error');
        }
    }

    public function depositCallback(Request $request)
    {
        $key = \config('rave.key');

        $status = $request->status;

        $ref = $request->tx_ref;

        if ($status ==  'successful') {
            $txn_id = $request->transaction_id;

            $response = Http::withHeaders([
                'Authorization' => $key
            ])->get('https://api.flutterwave.com/v3/transactions/' . $txn_id . '/verify');

            if ($response->successful()) {

                $body = $response->object();

                if ($body->status == 'success') {
                    $amount = $body->data->amount;
                    $charged_amount = $body->data->charged_amount;
                    $tx_ref = $body->data->tx_ref;
                    $flw_ref = $body->data->flw_ref;
                    $status = $body->data->status;
                    $currency = $body->data->currency;
                    $user = auth()->user();

                    $txn_data['amount'] = $amount;
                    $txn_data['user_id'] = auth()->id();
                    $txn_data['txn_type'] = 'deposit';
                    $txn_data['reference'] = $flw_ref;
                    $txn_data['status'] = $status;
                    $txn_data['balance'] = $user->wallet + $amount;

                    if (
                        $status == 'successful'
                        && $currency == 'UGX'
                        && $charged_amount == $amount
                        && $tx_ref == $ref
                    ) {

                        WalletTransaction::create($txn_data)->user()->increment('wallet', $amount);

                        auth()->user()->notify(new DepositNotification($txn_data));

                        return redirect()->route('wallet')->with('status', 'Your deposit is successful with reference code: ' . $flw_ref);
                    } elseif (
                        $status == 'successful'
                        && $currency == 'UGX'
                        && $charged_amount > $amount
                        && $tx_ref == $ref
                    ) {

                        WalletTransaction::create($txn_data)->user()->increment('user_id', $amount);

                        auth()->user()->notify(new DepositNotification($txn_data));

                        return redirect()->route('wallet')->with('status', 'Your deposit is successful with an extra charge refund in progress. For 
                        any queries contact us with reference: ' . $flw_ref);
                    } else {
                        return redirect()->route('wallet')->with('status', 'Your deposit verification was unsuccessful');
                    }
                } else {
                    return redirect()->route('wallet')->with('status', $body->message);
                }
            } else {
                return redirect()->route('wallet')->with('status', 'Unexpected Error');
            }
        } elseif ($status ==  'cancelled') {
            return redirect()->route('wallet')->with('status', 'Your deposit transaction has been cancelled');
        } else if ($status ==  'failed') {
            return redirect()->route('wallet')->with('status', 'Your deposit transaction has failed');
        }
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1',
            'tel' => 'required|digits:10'
        ]);

        $amount = $request->amount;

        $tel = $request->tel;

        $key = \config('rave.key');

        $fees = Http::withHeaders([
            'Authorization' => $key
        ])->get('https://api.flutterwave.com/v3/transfers/fee?currency=UGX&type=mobilemoney&amount=' . $amount);

        if ($fees->successful()) {

            if ($fees->object()->status == 'success') {

                $fee = $fees->object()->data[0]->fee;

                $total = $fee + $amount;

                $balance = auth()->user()->wallet;

                if ($total > $balance) {
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
                            "mobile_number" => "2560760109642"
                        ]
                    ]);

                    if ($response->successful()) {

                        $body = $response->object();

                        if ($body->status == 'success') {

                            $id = $body->data->id;

                            return redirect()->route('wallet.withdraw.callback',$id);
                        } else {
                            return redirect()->route('wallet')->with('status', $body->message);
                        }
                    } else {
                        return redirect()->route('wallet')->with('status', 'Unexpected error');
                    }
                }
            } else {
                return redirect()->route('wallet')->with('status', $fees->object()->message);
            }
        } else {
            return redirect()->route('wallet')->with('status', 'Unexpected Error');
        }
    }

    public function withdrawCallback($id)
    {
        $key = \config('rave.key');

        $response = Http::withHeaders([
            'Authorization' => $key
        ])->get('https://api.flutterwave.com/v3/transfers/' . $id);
        if ($response->successful()) {

            if ($response->object()->status == 'success') {
                $status = $response->object()->data->status;

                $amount = $response->object()->data->amount;

                $fee = $response->object()->data->fee;

                $ref = $response->object()->data->reference;

                $total = $amount + $fee;

                $user = auth()->user();

                $user_id = auth()->id();

                $txn_data['amount'] = $amount;
                $txn_data['user_id'] = $user_id;
                $txn_data['txn_type'] = 'withdraw';
                $txn_data['reference'] = $ref;
                $txn_data['status'] = $status;
                $txn_data['fee'] = $fee;
                $txn_data['balance'] = $user->wallet - $amount;
                $txn_data['created_at'] = Carbon::now();

                $txn_id = WalletTransaction::insertGetId($txn_data);

                WalletTransaction::find($txn_id)->user()->decrement('wallet', $total);

                $data = [
                    'id' => $id,
                    'txn_id' => $txn_id,
                    'key' => $key,
                    'user' => $user,
                    'wallet_balance' => $user->wallet
                ];

                CheckWithdrawStatus::dispatch($data)->delay(now()->addMinutes(10));

                return redirect()->route('wallet')->with('status', 'A new withdraw transaction has been initiated with reference code: ' . $ref);
            } else {
                return redirect()->route('wallet')->with('status', $response->object()->message);
            }
        } else {
            return redirect()->route('wallet')->with('status', 'Unexpected Error');
        }
    }
}
