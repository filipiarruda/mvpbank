<?php

namespace App\Http\Repositories;

use App\Models\Account;
class AccountRepository
{

    public function create (array $data)
    {
        return Account::create($data);
    }

}
