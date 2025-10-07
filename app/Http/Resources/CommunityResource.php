<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommunityResource extends JsonResource
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
            'name'              => $this->name,
            'number'            => $this->number,
            'zip_code'          => $this->zip_code,
            'email_responsible' => $this->email_responsbile,
            'phone'             => $this->phone,
            'image'             => $this->image,
            'status'            => $this->status,
            'created_at'        => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'        => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
