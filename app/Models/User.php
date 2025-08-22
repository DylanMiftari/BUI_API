<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pseudo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function companies(): HasMany {
        return $this->hasMany(Company::class, "userId", "id");
    }

    public function mines(): HasMany {
        return $this->hasMany(Mine::class, "userId", "id");
    }

    public function resources(): HasManyThrough {
        return $this->hasManyThrough(
            Resource::class,
            UserResource::class,
            "userId",
            "id",
            "id",
            "resourceId"
        );
    }

    public function userResources(): HasMany {
        return $this->hasMany(UserResource::class, "userId", "id");
    }

    public function city(): HasOne {
        return $this->hasOne(City::class, "id", "city_id");
    }

    public function resourceQuantity(): float {
        return UserResource::where("userId", $this->id)->sum("quantity");
    }
}
