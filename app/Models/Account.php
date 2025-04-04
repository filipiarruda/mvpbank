<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'name',
        'email',
        'mobile_phone',
        'birthdate',
        'cpf',
        'cnpj',
        'account_number',
        'agency_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
