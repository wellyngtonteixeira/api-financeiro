<?php

namespace App\Observers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemObserver
{
    public function creating(Item $item): void
    {
        $item->user_id = Auth::user()->id;
    }
}
