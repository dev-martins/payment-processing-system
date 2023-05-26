<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PixPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'transactionReceiptUrl' => $this->whenNotNull(isset($this->resource['transactionReceiptUrl']) ? $this->resource['transactionReceiptUrl'] : false),
            'encodedImage' => $this->whenNotNull(isset($this->resource['encodedImage']) ? $this->resource['encodedImage'] : false),
            'payload' => $this->whenNotNull(isset($this->resource['payload']) ? $this->resource['payload'] : false),
        ];
    }
}
