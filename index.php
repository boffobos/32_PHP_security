<?php
    require_once 'bootstrap.php';
    
    //require_once 'models/UserModel.php';
    //require_once 'controllers/Users.php';
    //$user = new Controller();
    //$user->loadView('register');

    //$userM = new UserModel();
    //echo $userM->findUserByEmail('test@example.com');

    $start = new Router();
    
    
   
   

   // print_r(hash_algos());
    $token = hash('sha256', random_int(0, 100000) );
    $_SESSION['pass_token'] = $token;
?>
    
