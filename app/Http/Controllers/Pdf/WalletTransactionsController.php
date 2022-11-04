<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Pdf;

class WalletTransactionsController extends Controller
{
    public function convert() {
        $now = Carbon::now();
        $user = auth()->user();
        $from = $user->walletTransactions()->first()->created_at->toDateString();
        $to = $user->walletTransactions()->latest()->first()->created_at->toDateString();
        $opening_balance = $user->walletTransactions()->first()->balance;
        $closing_balance = $user->walletTransactions()->latest()->first()->balance;
        $txns = $user->walletTransactions()->latest()->get();
        $pdf = Pdf::loadView('pdf.wallet-statement', compact('txns','now','from','to','opening_balance','closing_balance'));
        return $pdf->download('wallet-statement.pdf');
    }

    public function month() {
        $now = Carbon::now();
        $user = auth()->user();
        $txns = $user->walletTransactions()->where('created_at', '>', now()->subDays(30))->latest()->get();
        $from = $user->walletTransactions()->where('created_at', '>', now()->subDays(30))->first()->created_at->toDateString();
        $to = $user->walletTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->created_at->toDateString();
        $opening_balance = $user->walletTransactions()->where('created_at', '>', now()->subDays(30))->first()->balance;
        $closing_balance = $user->walletTransactions()->where('created_at', '>', now()->subDays(30))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.wallet-statement', compact('txns','now','from','to','opening_balance','closing_balance'));
        return $pdf->download('wallet-statement.pdf');
    }

    public function quarter() {
        $now = Carbon::now();
        $user = auth()->user();
        $txns = $user->walletTransactions()->where('created_at', '>', now()->subDays(90))->latest()->get();
        $from = $user->walletTransactions()->where('created_at', '>', now()->subDays(90))->first()->created_at->toDateString();
        $to = $user->walletTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->created_at->toDateString();
        $opening_balance = $user->walletTransactions()->where('created_at', '>', now()->subDays(90))->first()->balance;
        $closing_balance = $user->walletTransactions()->where('created_at', '>', now()->subDays(90))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.wallet-statement', compact('txns','now','from','to','opening_balance','closing_balance'));
        return $pdf->download('wallet-statement.pdf');
    }

    public function half() {
        $now = Carbon::now();
        $user = auth()->user();
        $txns = $user->walletTransactions()->where('created_at', '>', now()->subDays(180))->latest()->get();
        $from = $user->walletTransactions()->where('created_at', '>', now()->subDays(180))->first()->created_at->toDateString();
        $to = $user->walletTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->created_at->toDateString();
        $opening_balance = $user->walletTransactions()->where('created_at', '>', now()->subDays(180))->first()->balance;
        $closing_balance = $user->walletTransactions()->where('created_at', '>', now()->subDays(180))->latest()->first()->balance;
        $pdf = Pdf::loadView('pdf.wallet-statement', compact('txns','now','from','to','opening_balance','closing_balance'));
        return $pdf->download('wallet-statement.pdf');
    }
}
