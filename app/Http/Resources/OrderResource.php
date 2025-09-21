<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'community'         =>
            [
                'id'            => $this->community->id,
                'name'          => $this->community->name,
            ],
            'payment_type'      =>
            [
                'id'            => $this->paymentType->id,
                'name'          => $this->paymentType->name,
            ],
            'session'           =>
            [
                'id'            => $this->session->id,
                'user_code'     => $this->session->user->code,
                'user_name'     => $this->session->user->name,
                'date'          => DateTimeHelper::dateFormat($this->session->date),
                'entry_time'    => DateTimeHelper::timeFormat($this->session->entry_time),
                'exit_time'     => DateTimeHelper::timeFormat($this->session->exit_time),
                'entry_value'   => $this->session->entry_value,
                'exit_value'    => $this->session->exit_value,
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
