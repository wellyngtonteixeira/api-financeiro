<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'identify' => $this->id,
            'name' => strtoupper($this->name),
            'value' => $this->value,
            'measure' => strtoupper($this->measure),
            'dt_created' => Carbon::make($this->created_at)->format('Y-m-d'),
        ];
    }
}
