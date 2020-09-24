<?php
declare(strict_types=1);

namespace App\Modules\Transactions\Models;

use App\Traits\ReadOnlyTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Wallet
 * @package App\Modules\Transactions\Models
 * @property int $balance
 * @property string $address
 */
class Wallet extends Model
{
    use ReadOnlyTrait;

    protected $table = 'wallets';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'balance',
        'user_id',
    ];
}
