<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Http\Controllers\Auth\RegisterController;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = ''; // 🔹 Adicionando um valor padrão vazio
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $type = '';
    public string $cpf = '';
    public string $cnpj = '';
    public string $mobile_phone = '';
    public string $birthdate = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // // 🔹 Testar para ver se o nome está chegando corretamente

        // $validated = $this->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        //     'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        //     'type' => ['required', 'string', 'in:people,company'],
        // ]);

        // $validated['password'] = Hash::make($validated['password']);

        // event(new Registered(($user = User::create($validated))));

        $request = new \Illuminate\Http\Request([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'type' => $this->type,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'mobile_phone' => $this->mobile_phone,
            'birthdate' => $this->birthdate,
        ]);

        $user = app(RegisterController::class)->register($request);
        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    public function updatedType($value)
    {
        if ($value === 'people') {
            $this->cpf = '';
            $this->phone = '';
        } elseif ($value === 'company') {
            $this->cpf = '';
            $this->phone = '';
        }
    }



    public function render()
    {
        return view('livewire.auth.register');
    }
}
