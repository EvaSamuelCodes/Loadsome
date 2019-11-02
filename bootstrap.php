<?php

class Bootstrap {
    use Helpers;
    use Route;
    public function __construct(){
        
        //Todo: 
        //1. load files and do boot strappy stuff.
        //2. load class and module based on the get_route function.

        $current_route = $this->get_route();
        $this->pretty($current_route);

    }
}