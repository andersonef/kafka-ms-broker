<?php

namespace App\Services;

use App\Connections\Database\PostgresConnection;
use App\Entities\RequestEntity;
use App\Repositories\Database\RequestRepository;
use App\Services\Queue\KafkaService;

class RequestService
{
    protected $repository;

    protected $kafkaService;

    public function __construct()
    {
        $this->repository = new RequestRepository(PostgresConnection::getActiveConnection());
        $this->kafkaService = new KafkaService();
    }

    public function createRequest($message): ?RequestEntity
    {
        $request = $this->repository->create([
            'message' => $message
        ]);

        if (is_null($request)) {
            return null;
        }
        
        $this->kafkaService->send(
            json_encode($request),
            'topic-a'
        );

        return $request;
    }

    public function getByToken(string $token): ?RequestEntity
    {
        $request = $this->repository->getByToken($token);

        return $request;
    }
}
