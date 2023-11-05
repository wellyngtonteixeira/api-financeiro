<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ItemResource;
use App\Models\Item;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ItemResource::collection(Item::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:items',
            'measure' => 'required|in:'.implode(',', ['G', 'KG', 'ML', 'L']),
        ]);

        if ($validator->fails()) {
            return $this->error('Algum dado não foi preenchido', 422, $validator->errors());
        }

        $created = Item::create($validator->validated());

        if ($created) {
            return $this->response('Item criado', 200, $created);
        }

        return $this->error('Item não criado', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
            'measure' => 'required|in:'.implode(',', ['G', 'KG', 'ML', 'L']),
        ]);

        if ($validator->fails()) {
            return $this->error('Algum dado não foi preenchido', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = $item->update([
            'measure' => $validated['measure'],
        ]);

        if ($updated) {
            return $this->response('Item atualizado', 200);
        }

        return $this->error('Item não atualizado', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $deleted = $item->delete();

        if ($deleted) {
            return $this->response('Item deletado', 200);
        }

        return $this->error('Item não deletado', 400);
    }
}
