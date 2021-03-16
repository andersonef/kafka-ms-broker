<?php

namespace App\Repositories\Database;

use App\Connections\Database\DatabaseConnectionAbstract;
use App\Entities\EntityAbstract;

abstract class RepositoryAbstract
{
    abstract function create(array $data): EntityAbstract;

    abstract function update(array $data, $id): bool;

    abstract function delete($id): bool;
}
