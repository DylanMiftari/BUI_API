<?php 

namespace App\Http\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginAction {

    public function handle(string $pseudo, string $password) {
        $user = User::where("pseudo", $pseudo)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Incorrect password'],
            ]);
        }

        return $user;
    }

}