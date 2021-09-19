<?php
    require_once 'bootstrap.php';
    require_once 'lib/Database.php';
    require_once 'controllers/Users.php';
    require_once 'models/UserModel.php';

    // $userModel = new UserModel();

    // $user = $userModel->getUserByEmail('test@example.com');
    // // if($userModel->setUserRole(10, 'user')){
    // //     $userRights = $userModel->getUserRights(10);
    // // }
    // var_dump($user);

    
    // $params = [
    //     'client_id' => '7954456',
    //     'redirect_uri' => URLROOT . '/test.php',
    //     'response_type' => 'code',
    //     'v' => '5.131',
    //     'scope' => 'photos, offline',

    // ];

    // echo '<a href="https://oauth.vk.com/authorize?' . urldecode(http_build_query($params)) . '">Login via VK</a>';
        // use Monolog\Logger;
        // use Monolog\Handler\StreamHandler;
        // use Monolog\Formatter\HtmlFormatter;

        // // Создаем логгер 
        // $log = new Logger('mylogger');

        // // Хендлер, который будет писать логи в "mylog.log" и слушать все ошибки с уровнем "WARNING" и выше .
        // $log->pushHandler(new StreamHandler('mylog.log', Logger::WARNING));

        // // Хендлер, который будет писать логи в "troubles.log" и реагировать на ошибки с уровнем "ALERT" и выше.
        // $log->pushHandler(new StreamHandler('troubles.log', Logger::ALERT));


        // // Добавляем записи
        // $log->warning('Предупреждение');
        // $log->error('Большая ошибка');
        // $log->info('Просто тест');
        echo time();