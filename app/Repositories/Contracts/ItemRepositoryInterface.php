<?php

namespace App\Repositories\Contracts;

use App\DTO\Supports\CreateItemDTO;
use App\DTO\Supports\UpdateItemDTO;
use stdClass;

interface ItemRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function new(CreateItemDTO $dto): stdClass;
    public function update(UpdateItemDTO $dto): stdClass|null;

}
