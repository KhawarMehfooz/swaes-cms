<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    public function created(Transaction $transaction)
    {
        $this->updateBalanceSheet($transaction);
    }

    public function updated(Transaction $transaction)
    {
        $this->updateBalanceSheet($transaction);
    }

    public function deleted(Transaction $transaction)
    {
        $this->updateBalanceSheet($transaction);
    }

    protected function updateBalanceSheet(Transaction $transaction)
    {
        $balanceSheet = $transaction->balanceSheet;

        if (! $balanceSheet) {
            return;
        }

        // Recalculate totals for this balance sheet
        $income = $balanceSheet->transactions()
            ->where('type', 'income')
            ->sum('amount');

        $expense = $balanceSheet->transactions()
            ->where('type', 'expense')
            ->sum('amount');

        $balanceSheet->closing_balance = $balanceSheet->opening_balance + $income - $expense;
        $balanceSheet->save();
    }
}
