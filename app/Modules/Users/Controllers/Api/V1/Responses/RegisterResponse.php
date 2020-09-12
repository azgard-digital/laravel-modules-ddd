<?php


namespace App\Modules\Users\Controllers\Api\V1\Responses;

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
            'name' => $this->resource->getName(),
            'email' => $this->resource->getEmail(),
            'token' => $this->resource->getToken(),
            'expire' => $this->resource->getExpire()
        ];
    }
}
