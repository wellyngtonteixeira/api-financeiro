<?php

namespace App\DTO\Supports;

use App\Http\Requests\StoreUpdateItem;

class CreateItemDTO
{
    public function __construct(
        public string $name,
        public double $value,
        public string $measure
    ){}

    public static function makeFromRequest(StoreUpdateItem $request): self
    {
        return new self(
            $request->name,
            $request->value,
            $request->measure
        );
    }
}
