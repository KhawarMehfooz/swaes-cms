<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeApplication extends Model
{
    use SoftDeletes;
    protected $fillable = [
        // Applicant details
        'name',
        'father_name',
        'cnic',
        'mobile_number',
        'address',

        // Institution details
        'institution_name',
        'session',
        'fee_type',
        'total_fee',
        'chalan_number',
        'bank',

        // Additional details
        'additional_details',

        // Guardian details
        'guardian_name',
        'guardian_cnic',
        'guardian_mobile_number',
        'guardian_address',
        'guardian_amount',

        'dated'
    ];

    protected $casts = [
        'total_fee' => 'decimal:2',
        'guardian_amount' => 'decimal:2',
        'dated' => 'date:Y-m-d'
    ];
}
