<?php

namespace App\Repositories\Database;

use App\Connections\Database\DatabaseConnectionAbstract;
use App\Entities\EntityAbstract;
use App\Entities\RequestEntity;

class RequestRepository extends RepositoryAbstract
{
    protected $databaseConnection;

    public function __construct(DatabaseConnectionAbstract $connection)
    {
        $this->databaseConnection = $connection;
    }


    public function create(array $values): EntityAbstract
    {
        $token = uniqid();
        $sql = "INSERT INTO broker(token, message) VALUES (:token, :message);";
        $insertedId = $this->databaseConnection->executeSql($sql, [
            'token' => $token,
            'message' => $values['message'] ?? ''
        ]);
        die($insertedId . 'akii');

        $request = $this->databaseConnection->query('select * from requests where id = :id', [
            'id' => $insertedId
        ]);

        return new RequestEntity($request[0]);
    }

    public function update(array $values, $id): bool
    {
        return true;
    }

    public function delete($id): bool
    {
        return true;
    }
}
