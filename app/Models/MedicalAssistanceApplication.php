<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalAssistanceApplication extends Model
{
    use SoftDeletes;

    protected $fillable = [
        // Guardian/Applicant details
        'applicant_name',
        'applicant_father_or_husband_name',
        'applicant_cnic',
        'applicant_mobile_number',
        'applicant_address',
        'applicant_occupation',
        'applicant_marital_status',

        // Patient details
        'patient_name',
        'patient_disease',
        'patient_cnic',
        'hospital_name',
        'date_of_admission',
        'doctor_name',
        'patient_needs',

        'application_date',
    ];

    protected $casts = [
        'application_date' => 'date:Y-m-d',
    ];
}
