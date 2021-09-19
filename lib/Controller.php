<?php 
    class Controller {
        public function __construct(){
            //
        }

        public function loadView($view, $data=null){
            include_once APPROOT . '/views/'. $view . '.php';
        }

        public function loadModel($model){
            include_once APPROOT . '/models/' . $model . '.php';
            return new $model();
        }
    }