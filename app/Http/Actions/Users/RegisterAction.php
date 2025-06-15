<?php

namespace App\Http\Actions\Users;

use App\Services\UserService;

class RegisterAction {
    public function __construct(private UserService $userService) {}

    public function handle(string $pseudo, string $password) {
        return $this->userService->createUser($pseudo, $password);
    }
}