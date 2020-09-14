<?php

namespace App\Modules\Transactions\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Modules\Users\Models
 */
class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'wallet_id', 'status',
        'amount', 'fee', 'details',
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'id', 'wallet_id');
    }
}
