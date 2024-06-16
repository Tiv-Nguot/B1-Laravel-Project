<?php

namespace App\Http\Resources\Friend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListRequestPaddingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $requester = [
            'requester_id' => $this->requester_id,
            'requester_name' => $this->requester->name,
            'status' => $this->status_id,
            

        ];
        return $requester;
    }
}
