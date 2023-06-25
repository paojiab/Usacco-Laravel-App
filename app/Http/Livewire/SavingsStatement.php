<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class SavingsStatement extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = 
    [
        'refresh-me' => '$refresh'
    ];

    public $account;

    public function render()
    {
        $account = $this->account;
        $transactions = $account->savingTransactions()->latest()->paginate(5);
        return view('livewire.savings-statement', [
            'txns' => $transactions,
        ]);
    }

    public function month() {
        $now = Carbon::now();
        $account = $this->account;
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->balance;
        $data = [
            'txns' => $txns,
            'now' => $now,
            'account' => $account,
            'from' => $from,
            'to' => $to,
            'opening_balance' => $opening_balance,
            'closing_balance' =>$closing_balance
        ];
        $pdf = Pdf::loadView('livewire.pdf.savings-statement', $data)->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "savings-statement.pdf"
        );
    }
}
