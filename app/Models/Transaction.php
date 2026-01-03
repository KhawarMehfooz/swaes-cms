<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'receipt_number',
        'balance_sheet_id',
        'amount',
        'purpose',
        'account_of_expense_id',
        'type',
        'donor_id',
        'dated',
    ];

    public function balanceSheet()
    {
        return $this->belongsTo(BalanceSheet::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function accountOfExpense()
    {
        return $this->belongsTo(AccountOfExpense::class);
    }
}
