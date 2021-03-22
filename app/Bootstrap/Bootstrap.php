<?php

namespace App\Bootstrap;

class Bootstrap
{
    use SetupConfigTrait;
    use RouteDispatcherTrait;

    static $config = [];

    public function dispatch(): void
    {
        $response = $this->processRoute();

        echo $response;
    }
}
