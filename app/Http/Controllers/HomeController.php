<?php

namespace App\Http\Controllers;

use App\Services\RequestService;

class HomeController
{
    protected $service;

    public function __construct()
    {
        $this->service = new RequestService();
    }

    public function index(): array
    {
        echo 'Will create a broker';
        $request = $this->service->createRequest('Hi');
        echo 'Request created';

        return (array) $request;
    }
}
