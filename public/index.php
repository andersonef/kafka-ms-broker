<?php
require('vendor/autoload.php');

use App\Bootstrap\Bootstrap;

$bootstrap = new Bootstrap();

$bootstrap->setup();

$bootstrap->dispatch();
