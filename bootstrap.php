<?php

    require_once 'helpers/url_helper.php';
    require_once 'helpers/flash.php';
    require_once 'helpers/crypto_helper.php';
    require_once 'helpers/log_helper.php';
    require_once 'config/config.php';

    spl_autoload_register(function ($class_name) {
        include 'lib/' . $class_name . '.php'; #or
      //  include 'controllers/' . $class_name . '.php' or
       // include 'models/' . $class_name . '.php';
    });
