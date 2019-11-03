<?php

require_once 'config.php';

if (DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require_once PUBLIC_ROOT . '/system/Helpers.php';
require_once PUBLIC_ROOT . '/system/Routing.php';
require_once PUBLIC_ROOT . '/system/Core.php';
require_once PUBLIC_ROOT . '/system/Bootstrap.php';

$Core = new Core();

$Routing = $Core->get_route();
$Core->pretty($Routing);
