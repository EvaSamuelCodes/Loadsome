<?php

class Bootstrap extends System
{
    public function __construct()
    {
        $this->require_all(PUBLIC_ROOT);

        if(!$this->is_session_started()){
            session_start();
        }

        $this->implement_module();

    }
}
