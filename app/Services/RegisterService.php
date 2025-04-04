<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Repositories\AccountRepository;
use Illuminate\Validation\Rules;

class RegisterService
{
    protected $userRepository;
    protected $accountRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {

        $validated = validator($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', 'in:individual,bussiness'],
            'cpf' => ['nullable', 'required_if:type,individual', 'string'],
            'cnpj' => ['nullable', 'required_if:type,bussiness', 'string'],
            'mobile_phone' => ['nullable', 'required', 'string'],
            'birthdate' => ['nullable', 'required_if:type,individual', 'date'],
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        // $this->accountRepository->create([
        //     'user_id' => $user->id,
        //     'name' => $user->name,
        //     'email' => $user->email,
        //     'type' => $data['type'],
        //     'cpf' => $data['cpf'],
        //     'cnpj' => $data['cnpj'],
        //     'mobile_phone' => $data['mobile_phone'],
        //     'birthdate' => $data['birthdate'],
        // ]);

        return $user;
    }
}
