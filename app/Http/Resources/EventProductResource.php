<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'event'         =>
            [
                'id'    => $this->event->id,
                'name'  => $this->event->id
            ],
            'product'       =>
            [
                'id'    => $this->product->id,
                'name'  => $this->product->id
            ],
            'price'         => $this->price,
            'observation'   => $this->observation,
            'status'        => $this->status,
            'created_at'    => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'    => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
