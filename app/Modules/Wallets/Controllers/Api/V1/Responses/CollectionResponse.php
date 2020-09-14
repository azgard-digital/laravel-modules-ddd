<?php


namespace App\Modules\Wallets\Controllers\Api\V1\Responses;


use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => $this->resource
        ];
    }
}
