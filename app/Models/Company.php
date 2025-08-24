<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    public const COMPANY_TYPE = ["bank", "casino", "mafia", "estate", "factory", "security"];
    public const MAX_LEVEL = 6;

    protected $table = "company";
    protected $fillable = ["name", "companyType", "userId"];


    public function user(): HasOne {
        return $this->hasOne(User::class, "id", "userId");
    }
}
