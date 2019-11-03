<?php

class Bootstrap extends System
{
    public function __construct()
    {
        $this->require_all(PUBLIC_ROOT);
        $this->implement_module();

    }
}
