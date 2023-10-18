<?php

namespace App\DTO\Supports;

use App\Http\Requests\StoreUpdateItem;

class UpdateItemDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public double $value,
        public string $measure,
    ) {}

    public static function makeFromRequest(StoreUpdateItem $request, string $id = null): self
    {
        return new self(
            $id ?? $request->id,
            $request->name,
            $request->value,
            $request->measure
        );
    }
}
