<?php 

namespace App\Services;

use App\Models\Home;
use App\Models\House;
use App\Models\Mine;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService {

    /**
     * Create a new user with all stuff (house, home)
     * @param string $pseudo
     * @param string $password
     * @return User
     */
    public function createUser(string $pseudo, string $password) {
        $user = DB::transaction(function() use ($pseudo, $password) {
            $user = User::create([
                "pseudo" => $pseudo,
                "password" => Hash::make($password)
            ]);
            $house = House::create([
                "houseTypeId" => config("user.start_house_type_id"),
                "cityId" => config("user.start_city_id")
            ]);
            $home = Home::create([
                "houseId" => $house->id,
                "userId" => $user->id
            ]);
            $mine = Mine::create([
                "userId" => $user->id
            ]);

            return $user;
        });

        return $user;
    }

}