<?php


class App extends Auth {

    private $controller = "HomeController";
    private $action = "index";
    private $params = [];

    function __construct()
    {

        $arr_URL = $this->processURL();
        /*
        * --------------------------------------------------------------------
        * Handle controller
        * --------------------------------------------------------------------
        */

        if(!empty($arr_URL[0])) {
            if( file_exists(CONTROLLERSPATH.DIRECTORY_SEPARATOR.$arr_URL[0]."Controller.php") ) {
                $this->controller = $arr_URL[0]."Controller";
            } else {
                $this->controller = "Page404Controller";
                $this->action     = "error404";
            }
            unset($arr_URL[0]);
        }

        require_once CONTROLLERSPATH.DIRECTORY_SEPARATOR.$this->controller.".php";

        $this->controller = new $this->controller;
        /*
        * --------------------------------------------------------------------
        * Handle action
        * --------------------------------------------------------------------
        */

        if(!empty($arr_URL[1]) ) {
            if( method_exists($this->controller, $arr_URL[1]) ) {
                $this->action = $arr_URL[1];
            } else {
                $this->requirePage404();
            }
            unset($arr_URL[1]);
        }

        if(!method_exists($this->controller, $this->action)) {
            $this->requirePage404();
        }

        $this->checkReQuest($this->action);

        /* --------------------------------------------------------------------
        * Handle params
        * --------------------------------------------------------------------
        */
        $this->params = !empty($arr_URL) ? array_values($arr_URL) : [];

        call_user_func_array( [ $this->controller, $this->action ], $this->params );
    }

    private function processURL()
    {
        if(!empty($_GET['url'])) {
            return explode( "/", filter_var( trim($_GET['url'], "/") ) );
        }
    }


    public function requirePage404()
    {
        $this->controller = "page404";
        $this->action     = "error404";
        require_once CONTROLLERSPATH.DIRECTORY_SEPARATOR."Page404Controller.php";
        $this->controller = new Page404Controller;
    }

}
?>