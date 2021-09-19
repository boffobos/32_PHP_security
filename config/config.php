<?php
    define('DB_TYPE', 'pgsql:host=');
    define('DB_HOST', '192.168.1.250;');
    define('DB_NAME', 'php32;');
    define('DB_USER', 'student');
    define('DB_PASSWORD', '123456');

    //app constants
    define('URLROOT', 'http://localhost/32_PHP_security');
    define('APPROOT', dirname(__FILE__, 2));
    define('MIN_PASS_LENGTH', 6);
    define('DEFAULT_USER_ROLE', 'user');

    define('SITENAME', 'USERSITE');
    define('COOKIES_EXPIRE', 86400 * 15); /*days*/

    //vk autorization params
    define('CLIENT_ID', 'Enter your id here');
    define('VK_OAUTH_URL', 'https://oauth.vk.com/authorize');
    define('PROTECTED_KEY', 'enter your key here');
