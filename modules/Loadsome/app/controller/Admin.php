<?php 

    class Admin extends System{
        public function index(){
            $this->get_route();
            $this->render();
        }
        public function web_page(){
            $this->get_route();
            $this->render();
        }
    }