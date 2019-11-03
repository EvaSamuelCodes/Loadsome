<?php

require 'config.php';
require PUBLIC_ROOT . '/system/Helpers.php';
require PUBLIC_ROOT . '/system/Routing.php';
require PUBLIC_ROOT . '/system/Bootstrap.php';

new Bootstrap();

print "<pre>";
print_r($Routing);
