<?php

namespace App\Connections\Database;

use App\Bootstrap;
use PDO;
use Throwable;

class PostgresConnection extends DatabaseConnectionAbstract
{
    private static $connection = [];


    function getDsn(): string
    {
        $databaseConfig = CONFIG_APP['database']['connections'][$this->connectionName];

        return sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                $databaseConfig['host'], 
                $databaseConfig['port'], 
                $databaseConfig['db'], 
                $databaseConfig['user'], 
                $databaseConfig['password']);
    }
    
    public static function getActiveConnection(string $connectionName = 'default'): PostgresConnection
    {
        if (empty(self::$connection[$connectionName])) {
            $instance = new PostgresConnection($connectionName);
            $instance->connect();
            self::$connection[$connectionName] = $instance;
        }

        return self::$connection[$connectionName];
    }


    function executeStatement(string $sql): bool
    {
        $pdo = $this
            ->connect()
            ->getConnection();
        
        try {
            $pdo->exec($sql);
            return true;
        } catch (Throwable $t) {
            return false;
        }
    }

    function executeSql(string $sql, array $params)
    {
        $pdo = $this
            ->connect()
            ->getConnection();
        
        $statement = $pdo->prepare($sql);

        foreach ($params as $property => $value) {
            $statement->bindColumn(':' . $property, $value);
        }
        
        $statement->execute();

        $queryType = explode(' ', $sql)[0];
        if (strtoupper($queryType) == 'INSERT') {
            $tableName = explode(' ', $sql)[2];
            $sequencObjectName = strtolower($tableName) . '_id_seq';

            return $pdo->lastInsertId($sequencObjectName);
        }

        return $statement->rowCount();
    }

    function query(string $sql, array $params): array
    {
        $pdo = $this
            ->connect()
            ->getConnection();
        
        $statement = $pdo->query($sql);

        if (!$statement) {
            throw new \Exception('Invalid query: ' . $sql);
        }

        foreach ($params as $property => $value) {
            $statement->bindColumn(':' . $property, $value);
        }
        $response = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $response[] = $row;
        }

        return $response;
    }
}
