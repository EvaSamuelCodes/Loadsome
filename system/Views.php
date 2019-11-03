<?php
trait Views
{
    public function render()
    {
        if (!isset($this->route)) {
            exit("<h1>You can't render a view unless your method has called get_route() </h1><p>Sorry</p>");
        } else {
            $view = MODULE_ROOT . '/' . $this->route['module'] . '/app/view/' . $this->route['class'] . '/' . $this->route['method'] . '.php';
            $this->pretty($view);
            if (file_exists($view)) {
                require_once $view;
            } else {
                print "There is no view to see.";
            }
        }

    }
}
