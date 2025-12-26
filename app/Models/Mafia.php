<?php

namespace App\Models;

use App\Http\Controllers\CompanyController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mafia extends Model
{
    protected $table = "mafia";
    protected $fillable = ["companyId"];

    public function company(): HasOne {
        return $this->hasOne(Company::class, "id", "companyId");
    }

    public function mafiaLevel(): HasOne {
        return $this->hasOne(MafiaLevel::class, "level", "level");
    }
}
