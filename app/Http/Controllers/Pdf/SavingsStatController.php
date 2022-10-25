<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Pdf;

class SavingsStatController extends Controller
{
    public function convert($id) {
        $now = Carbon::now();
        $account = Account::find($id);
        $from = $account->savingTransactions()->first()->created_at->toDateString();
        $to = $account->savingTransactions()->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->first()->balance;
        $closing_balance = $account->savingTransactions()->latest()->first()->balance;
        $txns = $account->savingTransactions()->latest()->get();
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function month($id) {
        $now = Carbon::now();
        $account = Account::find($id);
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function quarter($id) {
        $now = Carbon::now();
        $account = Account::find($id);
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function half($id) {
        $now = Carbon::now();
        $account = Account::find($id);
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function adminConvert($id) {
        $now = Carbon::now();
        $account = Account::find($id);
        $from = $account->savingTransactions()->first()->created_at->toDateString();
        $to = $account->savingTransactions()->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->first()->balance;
        $closing_balance = $account->savingTransactions()->latest()->first()->balance;
        $txns = $account->savingTransactions()->latest()->get();
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function adminMonth($id) {
        $now = Carbon::now();
        $account = Account::find($id);
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function adminQuarter($id) {
        $now = Carbon::now();
        $account = Account::find($id);
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }

    public function adminHalf($id) {
        $now = Carbon::now();
        $account = Account::find($id);
        $txns = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->get();
        $from = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->first()->created_at->toDateString();
        $to = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->created_at->toDateString();
        $opening_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->first()->balance;
        $closing_balance = $account->savingTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.savings-statement', compact('txns','now','account','from','to','opening_balance','closing_balance'));
        return $pdf->download('savings-statement.pdf');
    }
}
