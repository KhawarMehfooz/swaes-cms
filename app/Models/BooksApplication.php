<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BooksApplication extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_name',
        'guardian_name',
        'guardian_cnic',
        'guardian_contact_number',
        'guardian_source_of_income',
        'student_address',
        'institution_name',
        'class',
        'stationary_details',

        'application_date',
        'scheme_year',
    ];

    protected $casts = [
        'application_date' => 'date:Y-m-d',
    ];
}
