<?php

require_once CONFIG_PATH . DIRECTORY_SEPARATOR . "Config.php";

class App extends Config
{
    private $controller;
    private $action;

    function __construct()
    {
        $this->AutoLoad();
        $this->Router();
        $this->handleCart();
    }

    public function handleCart() {
        @$cartCOOKIE = json_decode($_COOKIE['cart_TIENPHAT'], true);
        if( !empty($cartCOOKIE) ) {
            $_SESSION['cart'] = $cartCOOKIE;
        }
    }

    private function AutoLoad()
    {
        if(!empty($this->fileAutoLoadClass())) {
            foreach($this->fileAutoLoadClass() as $file) {
                require_once CORE_PATH . DIRECTORY_SEPARATOR . $file . ".php";
                $$file = new $file;
            }
        }
        if(!empty($this->fileAutoLoadFunc())) {
            foreach($this->fileAutoLoadFunc() as $file) {
                require_once CORE_PATH . DIRECTORY_SEPARATOR . $file . ".php";
            }
        }
        if(!empty($this->fileAutoLoadController())) {
            foreach($this->fileAutoLoadController() as $file) {
                require CONTROLLER_PATH . DIRECTORY_SEPARATOR . $file . ".php";
            }
        }
        if(!empty($this->fileAutoLoadModel())) {
            foreach($this->fileAutoLoadModel() as $file) {
                require MODEL_PATH . DIRECTORY_SEPARATOR . $file . ".php";
            }
        }
    }

    private function Router()
    {
        $this->controller = ucfirst(strtolower(!empty($_GET['controller']) ? $_GET['controller'] : $this->controllerConfig) . "Controller");
        $this->action = !empty($_GET['action']) ? $_GET['action'] : $this->actionConfig;

        /**
         * ----- Handle Controller -----
         */
        if(file_exists(CONTROLLER_PATH . DIRECTORY_SEPARATOR . $this->controller.".php")) {
            require_once CONTROLLER_PATH . DIRECTORY_SEPARATOR . $this->controller.".php";
        } else {
            echo "File Not Found !!!";
        }

        $this->controller = new $this->controller;

        /**
         * ----- Handle Action -----
         */
        if(method_exists($this->controller, $this->action)) {
            call_user_func ( [ $this->controller, $this->action ]);
        } else {
            echo "Method Not Found !!!";
        }
    }
}