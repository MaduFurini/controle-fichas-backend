<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'                => $this->uuid,
            'event_product'     =>
            [
                'uuid'            => $this->eventProduct->uuid,
                'event_uuid'      => $this->eventProduct->event->uuid,
                'event_name'    => $this->eventProduct->event->name,
                'product_uuid'    => $this->eventProduct->product->uuid,
                'product_name'  => $this->eventProduct->product->name,
            ],
            'code'              => $this->code,
            'total_value'       => $this->total_value,
            'date'              => DateTimeHelper::dateFormat($this->date),
            'status'            => $this->status,
            'created_at'        => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'        => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
