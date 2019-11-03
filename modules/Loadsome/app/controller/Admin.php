<?php 

    class Admin extends Core{
        public function index(){
            $route = $this->get_route();
            print "Hi world. <a href='/modules/Loadsome/Admin/web_page'>Link</a>";
            $this->pretty($route);
        }
        public function web_page(){
            print "I am another method.";
        }
    }