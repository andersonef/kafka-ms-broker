<?php

namespace App\Bootstrap;

trait SetupConfigTrait
{
    public function setup(): void
    {
        $basePath = empty($_SERVER['DOCUMENT_ROOT']) 
            ? 'config'
            : $_SERVER['DOCUMENT_ROOT'] . '/../config';
        $basePath = 'config';

        $configFiles = scandir($basePath);
        $ignore = ['.', '..'];
        foreach ($configFiles as $configFile) {
            if (in_array($configFile, $ignore)) {
                continue;
            }

            require($basePath . DIRECTORY_SEPARATOR . $configFile);
        }
    }
}
