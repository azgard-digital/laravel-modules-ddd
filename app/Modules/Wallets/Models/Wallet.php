<?php


namespace App\Modules\Wallets\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Wallet
 * @package App\Modules\Wallets\Models
 * @property int $balance
 * @property string $address
 */
class Wallet extends Model
{
    protected $table = 'wallets';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'balance', 'user_id',
    ];
}
