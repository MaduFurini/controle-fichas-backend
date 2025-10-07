<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCommunityResource extends JsonResource
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
            'user'          =>
            [
                'uuid'    => $this->user->uuid,
                'code'  => $this->user->code,
                'name'  => $this->user->name,
            ],
            'created_at'    => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'    => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
