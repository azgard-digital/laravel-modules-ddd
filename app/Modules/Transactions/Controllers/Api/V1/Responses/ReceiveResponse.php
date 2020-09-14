<?php


namespace App\Modules\Transactions\Controllers\Api\V1\Responses;


use Illuminate\Http\Resources\Json\JsonResource;

class ReceiveResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => $this->resource
        ];
    }
}
