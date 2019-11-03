<?php 

    class Admin extends Core{
        public function index(){
            $this->get_route();
            $this->render();
        }
        public function web_page(){
            $this->get_route();
            $this->render();
        }
    }