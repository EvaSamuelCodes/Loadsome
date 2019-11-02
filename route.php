<?php

trait Routing
{
    public $address = [];
    public $params = [];
    public $route = [];

    //The format on this one's a little different than the one in the store app
    //because this one's module driven. So there's an extra paramater. Also, a values array. :) -Ev

    /*format like this:
    http://localhost:8080/Bravheart/Freedom/Monkey/Scream/Plastic/Genius

    And that gives us this array.
    Array
    (
    [module] => Bravheart
    [class] => Freedom
    [method] => Monkey
    [values] => Array
    (
    [0] => Scream
    [1] => Plastic
    [2] => Genius
    )
    )
     */

    public function get_route()
    {
        $this->address = explode('/', substr($_SERVER['REQUEST_URI'], 1, 255)); //you don't need more than this
        $this->params = [];

        //Build your paramaters.

        if (isset($this->address[3])) {
            foreach ($this->address as $key => $value) {
                if ($key > 2) {
                    $this->params[] = filter_var($value, FILTER_SANITIZE_STRING);
                }

            }
        }

        //Setting up blank array space, in case we need it.
        
        if (!isset($this->address[0])) {$this->address[0] = '';}
        if (!isset($this->address[1])) {$this->address[1] = '';}
        if (!isset($this->address[2])) {$this->address[2] = '';}

        //Set up the route and hold on to it.

        $this->route = [
            'module' => ($this->address[0] == '' ? DEFAULT_MODULE : filter_var($this->address[0], FILTER_SANITIZE_STRING)),
            'class' => ($this->address[1] == '' ? DEFAULT_CLASS : filter_var($this->address[1], FILTER_SANITIZE_STRING)),
            'method' => ($this->address[2] == '' ? 'index' : filter_var($this->address[2], FILTER_SANITIZE_STRING)),
            'values' => $this->params,
        ];

        return $this->route;
    }

}
