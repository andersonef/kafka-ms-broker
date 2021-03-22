<?php

namespace App\Http\Controllers;

use App\Services\RequestService;

class RequestController
{
    protected $service;

    public function __construct()
    {
        $this->service = new RequestService();
    }

    public function store(): array
    {
        $request = $this->service->createRequest('Hi');
        
        return (array) $request ?: ['status' => 'error', 'message' => 'Could not create request.'];
    }

    public function read(): array
    {
        if (empty($_GET['token'])) {
            return [
                'status' => 'error',
                'message' => 'You need to pass the "token" queryString to consume this endpoint!',
            ];
        }
        $request = $this->service->getByToken($_GET['token']);

        return (array) $request ?: ['status' => 'error', 'message' => 'Token not found!'];
    }
}
