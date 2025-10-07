<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalAccessTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'            => $this->uuid,
            'community'     =>
            [
                'uuid'    => $this->community->uuid,
                'name'  => $this->community->name,
            ],
            'reference_uuid'  => $this->reference_uuid,
            'module'        => $this->module,
            'token'         => $this->token,
            'expires_at'    => DateTimeHelper::dateTimeToMinus3Format($this->expires_at),
            'created_at'    => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'    => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
