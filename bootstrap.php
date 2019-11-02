<?php

class Bootstrap
{
    use Helpers;
    use Routing;

    public function __construct()
    {
        $this->require_all(PUBLIC_ROOT);

            //Todo:
            //1. load files and do boot strappy stuff.
            //2. load class and module based on the get_route function.

            $current_route = $this->get_route();
            $this->pretty($current_route);


    }
}
