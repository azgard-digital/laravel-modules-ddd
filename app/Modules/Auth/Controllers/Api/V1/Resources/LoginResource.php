<?php
declare(strict_types=1);

namespace App\Modules\Auth\Controllers\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LoginResponse
 * @package App\Modules\Auth\Controllers\Api\V1\Resources
 */
class LoginResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'token' => $this->resource->getToken(),
            'expire' => $this->resource->getExpire()
        ];
    }
}
