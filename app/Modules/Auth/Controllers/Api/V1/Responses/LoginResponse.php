<?php


namespace App\Modules\Auth\Controllers\Api\V1\Responses;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LoginResponse
 * @package App\Modules\Auth\Controllers\Api\V1\Responses
 */
class LoginResponse extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'token' => $this->resource->getToken(),
            'expire' => $this->resource->getExpire()
        ];
    }
}
