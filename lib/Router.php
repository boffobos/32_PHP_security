<?php
    class Router {

        private $currentController = 'Users';
        private $currentAction = 'main';
        
        public function __construct(){

            require_once APPROOT . '/controllers/Users.php';
            (new Users()); //check users cookies

            if(!empty($_GET)){
                if(!empty($_GET['page'])){
                    $this->currentController = ucwords($_GET['page']);
                    
                }
                if(!empty($_GET['action'])){
                    $this->currentAction = $_GET['action'];
                }
                if(isset($_GET['code'])){
                    $this->currentAction = 'vklogin';
                }
                
            }

            
            require_once dirname(__FILE__, 2) . '/controllers/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;
            
            $args = [];
            call_user_func_array([$this->currentController, $this->currentAction], $args);
        }
    }