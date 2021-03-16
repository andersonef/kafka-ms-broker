<?php

namespace App\Services;

use App\Connections\Database\PostgresConnection;
use App\Entities\RequestEntity;
use App\Repositories\Database\RequestRepository;

class RequestService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new RequestRepository(PostgresConnection::getActiveConnection());
    }

    public function createRequest($message): RequestEntity
    {
        $request = $this->repository->create([
            'message' => $message
        ]);
        
        $this->sendToQueue($request);

        return $request;
    }

    public function sendToQueue(RequestEntity $request): void
    {
        // TODO: Send $broker to kafka queue here
    }
}
