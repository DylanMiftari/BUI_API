<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    public const COMPANY_TYPE = ["bank", "casino", "mafia", "estate", "factory", "security"];
    public const MAX_LEVEL = 6;

    protected $table = "company";
    protected $fillable = ["name", "companyType", "userId", "cityId"];


    public function user(): HasOne {
        return $this->hasOne(User::class, "id", "userId");
    }

    public function bank(): HasOne {
        return $this->hasOne(Bank::class, "idCompany", "id");
    }

    public function casino(): HasOne {
        return $this->hasOne(Casino::class, "companyId", "id");
    }

    public function mafia(): HasOne {
        return $this->hasOne(Mafia::class, "companyId", "id");
    }

    public function estate(): HasOne {
        return $this->hasOne(EstateAgency::class, "companyId", "id");
    }

    public function security(): HasOne {
        return $this->hasOne(SecurityCompany::class, "companyId", "id");
    }

    public function factory(): HasOne {
        return $this->hasOne(Factory::class, "companyId", "id");
    }

    public function getSubCompanyId(): int {
        if($this->bank) {
            return $this->bank->id;
        }
        if($this->casino) {
            return $this->casino->id;
        }
        if($this->mafia) {
            return $this->mafia->id;
        }
        if($this->estate) {
            return $this->estate->id;
        }
        if($this->factory) {
            return $this->factory->id;
        }
        if($this->security) {
            return $this->security->id;
        }
    }
}
