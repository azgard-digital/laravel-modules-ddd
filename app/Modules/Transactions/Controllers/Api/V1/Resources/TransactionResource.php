<?php
declare(strict_types=1);

namespace App\Modules\Transactions\Controllers\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
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
