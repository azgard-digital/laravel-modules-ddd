<?php
declare(strict_types=1);

namespace App\Modules\Users\Controllers\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RegisterResource
 * @package App\Modules\Users\Controllers\Api\V1\Resources
 */
class RegisterResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->getName(),
            'email' => $this->resource->getEmail(),
            'token' => $this->resource->getToken(),
            'expire' => $this->resource->getExpire()
        ];
    }
}
