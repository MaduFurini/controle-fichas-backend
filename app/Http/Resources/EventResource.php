<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'community'     =>
            [
                'id'    => $this->community->id,
                'name'  => $this->community->name,
            ],
            'name'          => $this->name,
            'description'   => $this->description,
            'start_date'    => DateTimeHelper::dateFormat($this->start_date),
            'end_date'      => DateTimeHelper::dateFormat($this->end_date),
            'status'        => $this->status,
            'created_at'    => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'    => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
