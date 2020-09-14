<?php


namespace App\Modules\Transactions\Controllers\Api\V1\Responses;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RegisterResponse
 * @package App\Modules\Users\Controllers\Api\V1\Responses
 */
class RegisterResponse extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'amount' => $this->resource->getAmount(),
            'from' => $this->resource->getFrom(),
            'to' => $this->resource->getTo(),
            'fee' => $this->resource->getFee(),
            'result' => $this->resource->getResult(),
        ];
    }
}
