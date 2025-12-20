<?php

namespace App\Models;

use App\Http\Resources\ResourceResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BankAccount extends Model
{
    protected $table = 'bankaccount';

    protected $fillable = [
        'accountMaintenanceCost',
        'transferCost',
        'money',
        'maxMoney',
        'maxResource',
        'bankId',
        'userId',
        'isEnable',
    ];

    protected function casts(): array
    {
        return [
            'isEnable' => 'boolean',
        ];
    }

    public function bank(): HasOne {
        return $this->hasOne(Bank::class, 'id', 'bankId');
    }

    public function bankResourceAccount(): HasMany {
        return $this->hasMany(BankResourceAccount::class, 'bankAccountId', 'id');
    }

    public function transactions(): HasMany {
        return $this->hasMany(BankAccountTransaction::class, 'bankAccountId', 'id');
    }

    public function creditCapacity(): float {
        return round($this->maxMoney - $this->money, 2);
    }
    public function debitCapacity(): float {
        return round(100 * $this->money / (100 + $this->transferCost), 2);
    }

    public function resourceQuantity(): float {
        return round($this->bankResourceAccount->sum("quantity"), 2);
    }

    public function resources(): array {
        $bankResourceAccounts = $this->bankResourceAccount;
        $bankResourceAccountsId = $bankResourceAccounts->pluck("resourceId");
        $resources = Resource::whereIn("id", $bankResourceAccountsId)->get();

        $res = [];
        foreach($bankResourceAccounts as $bankResourceAccount) {
            $resource = $resources->where("id", $bankResourceAccount->resourceId)->first();
            array_push($res, [
                "resource" => new ResourceResource($resource),
                "quantity" => $bankResourceAccount->quantity,
            ]);
        }
        return $res;
    }

    public function resourcesCapacity(): float {
        $totalResources = $this->bankResourceAccount()->sum("quantity");
        return round($this->maxResource - $totalResources, 2);
    }

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
