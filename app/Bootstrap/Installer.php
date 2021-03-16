<?php

namespace App\Bootstrap;

use App\Connections\Database\PostgresConnection;

class Installer
{
    use SetupConfigTrait;

    public function install(): void
    {
        $this->setup();
        $this->installDatabase();
    }

    protected function installDatabase(): void
    {
        $statement = <<<STATEMENT
CREATE TABLE IF NOT EXISTS requests (
    id serial PRIMARY KEY,
    token character varying(32) NOT NULL UNIQUE,
    message character varying(255) NOT NULL
);
STATEMENT;
        $connection = PostgresConnection::getActiveConnection('default');
        $connection->executeStatement($statement);
        echo '-> requests table successfully created' . PHP_EOL;
    }
}
