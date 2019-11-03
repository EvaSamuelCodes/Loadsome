<?php

trait Routing
{
    public $address = [];
    public $params = [];
    public $route = [];

    // The format on this one's a little different than the one in the store app
    // because this one's module driven. So there's an extra paramater. Also, a values array. :) -Ev

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

        // Build your paramaters.

        if (isset($this->address[3])) {
            foreach ($this->address as $key => $value) {
                if ($key > 2) {
                    $this->params[] = $this->fix_address_string($value);
                }

            }
        }

        // Setting up blank array space, in case we need it.

        if (!isset($this->address[0])) {$this->address[0] = '';}
        if (!isset($this->address[1])) {$this->address[1] = '';}
        if (!isset($this->address[2])) {$this->address[2] = '';}

        // Set up the route and hold on to it.

        $this->route = [
            'module' => ($this->address[0] == '' ? DEFAULT_MODULE : $this->fix_address_string($this->address[0])),
            'class' => ($this->address[1] == '' ? DEFAULT_CLASS : $this->fix_address_string($this->address[1])),
            'method' => ($this->address[2] == '' ? 'index' : $this->fix_address_string($this->address[2])),
            'values' => $this->params,
        ];

        return $this->route;
    }

    // Borrowing this from the spystuff fish bowl class.
    // It changed a little, but the mechanics are basically the same.
    // As long as I'm the only one writing against this, it should be fine, but if it's ever used
    // as a general purpose framework (which I doubt, seriously) this would probably need need
    // to be classed and namespaced.

    public function implement_module()
    {
        $this->get_route();

        // Find your controller, and determine that the class exists.

        $file = MODULE_ROOT . '/' . $this->route['module'] . '/app/controller/' . $this->route['class'] . '.php';

        if (file_exists($file)) {

            if (class_exists($this->route['class'])) {

                $object = $this->route['class'];

                if (method_exists($this->route['class'], $this->route['method'])) {

                    $application_object = new $object();
                    call_user_func([$application_object, $this->route['method']], $this);

                } else {
                    header("HTTP/1.0 404 Not Found");
                    exit("Sorry, couldn't establish route for: {$this->route['class']}/{$this->route['method']}");
                }
            } else {
                header("HTTP/1.0 404 Not Found");
                print "Trying to open: {$file}\n";
                exit("class does not exist.");
            }
        }else{
            header("HTTP/1.0 404 Not Found");
            print "Trying to open: {$file}\n";
            exit("Module does not exist.");
        }
    }

}
