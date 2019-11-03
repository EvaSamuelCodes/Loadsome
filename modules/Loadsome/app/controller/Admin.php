<?php 

    class Admin extends Core{
        public function index($route){
            print "Hi world.";
            $this->pretty($route);
        }
    }