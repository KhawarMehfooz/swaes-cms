<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpensesApplication extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shop_name',
        'shop_address',
        'details',

        'application_date'
    ];

    protected $casts = [
        'application_date' => 'date:Y-m-d'
    ];
}
