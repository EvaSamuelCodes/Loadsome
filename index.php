<?php

require 'config.php';

if (DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require PUBLIC_ROOT . '/system/Helpers.php';
require PUBLIC_ROOT . '/system/Routing.php';
require PUBLIC_ROOT . '/system/Bootstrap.php';

new Bootstrap();

print "<pre>";
print_r($Routing);
