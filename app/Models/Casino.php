<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Casino extends Model
{
    protected $table = "casino";
    protected $fillable = ["companyId"];

    public function company(): HasOne {
        return $this->hasOne(Company::class, 'id', 'companyId');
    }
}
