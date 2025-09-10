<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'donor_name',
        'donor_cnic',
        'donor_contact_number'
    ];

    public function donations(){
        return $this->hasMany(Transaction::class);
    }
}
