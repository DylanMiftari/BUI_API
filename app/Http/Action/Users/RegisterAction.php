<?php

namespace App\Http\Action\Users;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class RegisterAction {
    public function __construct(private UserService $userService) {}

    public function handle(string $pseudo, string $password) {
        return $this->userService->createUser($pseudo, $password);
    }
}