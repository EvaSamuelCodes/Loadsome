<?php 

    class Admin extends Bootstrap{

        use Routing;
        use Helpers;

        public function index(array $route, array $params){
            print "Hi world.";
            $this->pretty($route);
        }
    }