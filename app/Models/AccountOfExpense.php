<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountOfExpense extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','description'];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
