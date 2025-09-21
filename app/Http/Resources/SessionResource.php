<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'user'          =>
            [
                'id'    => $this->user->id,
                'code'  => $this->user->code,
                'name'  => $this->user->name,
            ],
            'event'         =>
            [
                'id'    => $this->event->id,
                'name'  => $this->event->id
            ],
            'date'          => DateTimeHelper::dateFormat($this->date),
            'entry_time'    => DateTimeHelper::timeFormat($this->entry_time),
            'exit_time'     => DateTimeHelper::timeFormat($this->exit_time),
            'entry_value'   => $this->entry_value,
            'exit_value'    => $this->exit_value,
            'created_at'    => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'    => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
