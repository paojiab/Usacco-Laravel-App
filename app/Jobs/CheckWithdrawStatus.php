<?php

namespace App\Jobs;

use App\Models\SavingTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CheckWithdrawStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::withHeaders([
            'Authorization' => $this->data['key']
        ])->get('https://api.flutterwave.com/v3/transfers/' . $this->data['id']);

        $status = $response->object()->data->status;

        if($status == 'SUCCESSFUL') {
            SavingTransaction::find($this->data['txn_id'])->update([
                'status' => $status
            ]);
        }

        else if($status == 'FAILED') {
            SavingTransaction::find($this->data['txn_id'])->update([
                'status' => $status
            ])->increment('account_balance', $this->data['total']);
        }

        else if($status == 'PENDING') {
            SavingTransaction::find($this->data['txn_id'])->update([
                'status' => $status
            ]);
        }
    
    }
}
