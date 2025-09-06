<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'balance_sheet_id',
        'amount',
        'purpose',
        'type',
        'amount',
        'donor_id'
    ];

    public function balanceSheet(){
        return $this->belongsTo(BalanceSheet::class);
    }

    public function donor(){
        return $this->belongsTo(Donor::class);
    }
}
