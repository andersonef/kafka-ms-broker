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
        $sql = "INSERT INTO requests(token, message) VALUES (?, ?);";
        $insertedId = $this->databaseConnection->executeSql($sql, [
            $token,
            $values['message'] ?? ''
        ]);

        $request = $this->databaseConnection->query('select * from requests where id = :id', [
            'id' => $insertedId
        ]);

        return (is_null($request[0])) ? null : new RequestEntity($request[0] ?? null);
    }

    public function getByToken(string $token): ?EntityAbstract
    {
        $sql = 'SELECT * FROM requests where token = :token';
        $data = $this->databaseConnection->query($sql, [
            'token' => $token
            ]
        );

        return (is_null($data[0])) ? null : new RequestEntity($data[0]);
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
