<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bank extends Model
{
    protected $table = "bank";
    protected $fillable = ["idCompany"];

    public function bankLevel(): HasOne {
        return $this->hasOne(BankLevel::class, "level", "level");
    }

    public function bankAccounts(): HasMany {
        return $this->hasMany(BankAccount::class, "bankId", "id");
    }

    public function company(): HasOne {
        return $this->hasOne(Company::class, "id", "idCompany");
    }
}
