<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public const COMPANY_TYPE = ["bank", "casino", "mafia", "estate", "factory", "security"];

    protected $table = "company";
    protected $fillable = ["name", "companyType", "userId"];
}
