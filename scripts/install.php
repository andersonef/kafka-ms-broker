<?php
require('vendor/autoload.php');

use App\Bootstrap\Installer;

echo '-> Starting installation' . PHP_EOL;

$installer = new Installer();
$installer->install();

echo '-> Finished installation' . PHP_EOL;
