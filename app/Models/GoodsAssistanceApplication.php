<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsAssistanceApplication extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'goods_details',
        'payment_details',
        'cheque_and_bill_number',
        'receiver_name',
        'receiver_cnic',
        'receiver_mobile_number',

        'application_date'
    ];

    protected $casts = [
        'application_date' => 'date:Y-m-d',
    ];
}
