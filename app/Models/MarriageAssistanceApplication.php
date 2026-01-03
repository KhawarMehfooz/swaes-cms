<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarriageAssistanceApplication extends Model
{
    use SoftDeletes;

    protected $fillable = [

        // Guardian/Applicant details
        'applicant_name',
        'applicant_father_or_husband_name',
        'applicant_address',
        'applicant_cnic',
        'applicant_occupation',
        'applicant_mobile_number',
        'applicant_family_members',

        // Bride details
        'bride_name',
        'bride_education',
        'bride_cnic',
        'bride_occupation',
        'bride_dob', // Date of birth
        'bride_marriage_status',
        'bride_needs',

        'application_date',
    ];

    protected $casts = [
        'application_date' => 'date:Y-m-d',
        'bride_dob' => 'date:Y-m-d',
    ];
}
