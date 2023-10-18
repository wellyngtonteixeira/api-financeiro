<?php

namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use App\DTO\Supports\CreateItemDTO;
use App\DTO\Supports\UpdateItemDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateItem;
use App\Http\Resources\ItemResource;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    public function __construct(
        protected ItemService $service,
    ) {
    }

    //
    public function index(Request $request)
    {
        $items = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 1),
            filter: $request->filter,
        );

        return ApiAdapter::toJson($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateItem $request)
    {
        $item = $this->service->new(
            CreateItemDTO::makeFromRequest($request)
        );

        return (new ItemResource($item))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$item = $this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateItem $request, string $id)
    {
        $item = $this->service->update(
            UpdateItemDTO::makeFromRequest($request, $id)
        );

        if (!$item) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
