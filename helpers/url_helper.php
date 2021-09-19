<?php
    session_start();

    function redirect($page){
        header('location: ' . URLROOT. '/index.php?page=' . $page[0] . '&action=' . $page[1]);
    }

    function isLoggedIn(){
        return isset($_SESSION['user']);
    }

    function haveRight($rightNames) {

    }