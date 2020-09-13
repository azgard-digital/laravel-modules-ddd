<?php


namespace App\Modules\Wallets\Controllers\Api\V1\Responses;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RegisterResponse
 * @package App\Modules\Users\Controllers\Api\V1\Responses
 */
class WalletResponse extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'address' => $this->resource->getAddress(),
            'btc' => $this->resource->getBtcBalance(),
            'usd' => $this->resource->getUsdBalance()
        ];
    }
}
