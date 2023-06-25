<?php

namespace App\Http\Livewire\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;

class SavingsStatement extends Component
{
    public $account;

    public function render()
    {
        return view('livewire.pdf.savings-statement');
    }

    public function convert() {
        $now = Carbon::now();
        $account = $this->account;
        $from = $account->savingTransactions()->first()->created_at->toDateString();
        $to = $account->savingTransactions()->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->first()->balance;
        $closing_balance = $account->savingTransactions()->latest()->first()->balance;
        $txns = $account->savingTransactions()->latest()->get();
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function month() {
        $now = Carbon::now();
        $account = $this->account;
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function quarter() {
        $now = Carbon::now();
        $account = $this->account;
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function half() {
        $now = Carbon::now();
        $account = $this->account;
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function adminConvert() {
        $now = Carbon::now();
        $account = $this->account;
        $from = $account->savingTransactions()->first()->created_at->toDateString();
        $to = $account->savingTransactions()->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->first()->balance;
        $closing_balance = $account->savingTransactions()->latest()->first()->balance;
        $txns = $account->savingTransactions()->latest()->get();
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function adminMonth() {
        $now = Carbon::now();
        $account = $this->account;
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function adminQuarter() {
        $now = Carbon::now();
        $account = $this->account;
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function adminHalf() {
        $now = Carbon::now();
        $account = $this->account;
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }
}
