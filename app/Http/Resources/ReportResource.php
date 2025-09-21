<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'event'         =>
            [
                'id'    => $this->event->id,
                'name'  => $this->event->id
            ],
            'name'          => $this->name,
            'description'   => $this->description,
            'file'          => $this->file,
            'date'          => DateTimeHelper::dateFormat($this->date),
            'created_at'    => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'    => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
