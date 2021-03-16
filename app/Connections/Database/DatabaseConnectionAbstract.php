<?php 

namespace App\Connections\Database;

use PDO;
use RuntimeException;

abstract class DatabaseConnectionAbstract
{
    protected $connectionName;

    protected $pdoConnection;

    public function __construct($connectionName = 'default')
    {
        $this->connectionName = $connectionName;
    }

    abstract function executeStatement(string $sql): bool;

    abstract function executeSql(string $sql, array $params);

    abstract function query(string $sql, array $params): array;

    abstract function getDsn(): string;

    public function connect(): self
    {
        if ($this->pdoConnection) {
            return $this;
        }

        $dsn = $this->getDsn();
        $pdo = new PDO($dsn);

        if (!$pdo) {
            throw new RuntimeException('It was not possible to start a connection with your database.');
        }
        $this->pdoConnection = $pdo;

        return $this;
    }

    public function getConnection(): ?PDO
    {
        return $this->pdoConnection;
    }
}
