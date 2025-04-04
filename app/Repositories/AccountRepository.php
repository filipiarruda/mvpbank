<?php

namespace App\Repositories;

use App\Models\Account;
class AccountRepository
{

    public function create (array $data)
    {
        $lastAccountCreated = $this->lastAccountNumber();
        $accountNumber = $id = str_pad($lastAccountCreated + 1, 6, 0, STR_PAD_LEFT);
        $data['account_number'] = $accountNumber;
        $data['agency_number'] = 0001;
        return Account::create($data);
    }

    public function lastAccountNumber()
    {
        return Account::latest()->first()->account_number ?? 0;
    }

}
