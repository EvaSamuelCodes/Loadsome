<?php 

    class Admin extends Core{
        public function index(){
            $route = $this->get_route();
            print "Hi world.";
            $this->pretty($route);
        }
    }