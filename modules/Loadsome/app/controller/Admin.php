<?php 

    class Admin extends Core{

        use Routing;
        use Helpers;

        public function index(array $route, array $params){
            print "Hi world.";
            $this->pretty($route);
        }
    }