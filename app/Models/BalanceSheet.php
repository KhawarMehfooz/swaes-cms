<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceSheet extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'month',
        'opening_balance',
        'closing_balance',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($sheet) {
            $lastSheet = self::orderBy('month', 'desc')->first();

            if ($lastSheet) {
                // Auto-assign opening balance from last sheet's closing balance
                $sheet->opening_balance = $lastSheet->closing_balance;
            }

            // Always default status to draft
            $sheet->status = 'draft';

            // Ensure closing balance starts at 0
            $sheet->closing_balance = 0;
        });
    }

    public static function hasAnyBalanceSheet(): bool
    {
        return self::exists();
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

}
