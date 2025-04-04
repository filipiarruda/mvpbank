<?php

namespace App\Services;

use App\Models\User;
use App\Models\People;
use App\Models\Company;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisterService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {

        $validate = validator($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'type' => ['required', 'in:individual,bussiness'],
            'address' => ['nullable', 'required_if:type,people' 'string'],
            'cpf' => ['nullable', 'required_if:type,people', 'string'],
            'phone' => ['nullable', 'required_if:type,people', 'string'],
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        return $user;
    }
}
