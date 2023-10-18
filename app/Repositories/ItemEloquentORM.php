<?php

namespace App\Repositories;

use App\DTO\Supports\CreateItemDTO;
use App\DTO\Supports\UpdateItemDTO;
use App\Models\Item;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Contracts\PaginationInterface;
use Illuminate\Support\Facades\Gate;
use stdClass;

class ItemEloquentORM implements Contracts\ItemRepositoryInterface
{
    public function __construct(
        protected Item $model
    )
    {
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            //->with('replies.user')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('name', $filter);
                    $query->orWhere('value', $filter);
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    public function getAll(string $filter = null): array
    {
        return $this->model
            //->with('user')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('name', $filter);
                    $query->orWhere('value', $filter);
                }
            })
            ->get()
            ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {
        $item = $this->model->find($id);
        if (!$item) {
            return null;
        }

        return (object) $item->toArray();
    }

    public function delete(string $id): void
    {
        $item = $this->model->findOrFail($id);

//        if (Gate::denies('owner', $support->user->id)) {
//            abort(403, 'Not Authorized');
//        }

        $item->delete();
    }

    public function new(CreateItemDTO $dto): stdClass
    {
        $item = $this->model->create(
            (array) $dto
        );

        return (object) $item->toArray();
    }

    public function update(UpdateItemDTO $dto): stdClass|null
    {
        if (!$item = $this->model->find($dto->id)) {
            return null;
        }

//        if (Gate::denies('owner', $item->user->id)) {
//            abort(403, 'Not Authorized');
//        }

        $item->update(
            (array) $dto
        );

        return (object) $item->toArray();
    }
}
