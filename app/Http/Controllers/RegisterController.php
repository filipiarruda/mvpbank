<?php
namespace App\Http\Controllers\Auth;

use App\Http\Services\RegisterService;
use Illuminate\Http\Request;

class RegisterController
{
    protected RegisterService $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(array $data)
    {
        return $this->registerService->register($data);
    }
}
