<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
                'type' => ['required', 'in:individual,bussiness'],
                'cpf' => ['nullable', 'required_if:type,individual', 'string'],
                'cnpj' => ['nullable', 'required_if:type,bussiness', 'string'],
                'mobile_phone' => ['nullable', 'required', 'string'],
                'birthdate' => ['nullable', 'required_if:type,individual', 'date'],
            ]);
            $user = $this->registerService->register($validated);
            return response()->json(['message' => 'Usuário cadastrado com sucesso!', 'user' => $user], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
