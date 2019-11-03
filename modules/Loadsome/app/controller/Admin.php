<?php 

    class Admin extends Core{
        public function index($route, $params){
            $this->get_route();
            print "Hi world.";
            $this->pretty($route);
        }
    }