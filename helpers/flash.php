<?php
    function flash ($id, $message = ''){
        if(empty($message)){
            if(!empty($_SESSION['flash'][$id])){
                echo '<div class="alert alert-success alert-dismissible fade show pt-4" role="alert">' . $_SESSION['flash'][$id] . '</div>';
                unset($_SESSION['flash'][$id]);
            }
        } else {
            $_SESSION['flash'][$id] = $message;
        }
    }