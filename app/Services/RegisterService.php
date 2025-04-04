<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\DB;

class RegisterService
{
    protected $userRepository;
    protected $accountRepository;

    public function __construct(UserRepository $userRepository, AccountRepository $accountRepository)
    {
        $this->userRepository = $userRepository;
        $this->accountRepository = $accountRepository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return DB::transaction(function () use ($data) {

            $user = $this->userRepository->create($data);

            $this->accountRepository->create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'type' => $data['type'],
                'cpf' => $data['cpf'] ?? null,
                'cnpj' => $data['cnpj'] ?? null,
                'mobile_phone' => $data['mobile_phone'],
                'birthdate' => $data['birthdate'] ?? null,
            ]);

            return $user;
        });
    }
}
