<?php 

    class Admin extends Core{
        public function index(){
            $route = $this->get_route();
            print "Hi world. <a href='/Loadsome/Admin/web_page/1/2/3/4/5/6'>Link</a>";
            $this->pretty($route);
        }
        public function web_page(){
            $route = $this->get_route();
            print "I am another method.";
            $this->pretty($route);
        }
    }