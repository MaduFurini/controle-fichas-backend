<?php

namespace App\Http\Resources;

use App\Helpers\DateTimeHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category'      =>
            [
                'id'    => $this->category->id,
                'name'  => $this->category->name,
            ],
            'code'          => $this->code,
            'name'          => $this->name,
            'description'   => $this->description,
            'price'         => $this->price,
            'image'         => $this->image,
            'status'        => $this->status,
            'created_at'    => DateTimeHelper::dateTimeToMinus3Format($this->created_at),
            'updated_at'    => DateTimeHelper::dateTimeToMinus3Format($this->updated_at),
        ];
    }
}
