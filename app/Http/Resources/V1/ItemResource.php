<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    private array $measures = [
        'G' => 'Grama',
        'KG' => 'Quilo',
        'ML' => 'Mililitro',
        'L' => 'Litro',
    ];

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'measure' => $this->measures[$this->measure],
        ];

        return parent::toArray($request);
    }
}
