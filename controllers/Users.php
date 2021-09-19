<?php 
    class Users extends Controller {
        private $user;
        private $userModel;

        public function __construct(){
            $this->userModel = $this->loadModel('UserModel');
            echo $this->isKnownUser();
        }

        public function main(){
            $this->loadView('main');
        }

        //check if user set to remember him and make login automatik
        public function isKnownUser(){
            if(!empty($_COOKIE['session_token'])){
                $token = trim($_COOKIE['session_token']);
                $user = $this->userModel->getUserByToken($token);
                if($user){
                    $this->createUserSession($user);
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function register(){
            $data = [
                'full_name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'full_name_err' =>'',
                'email_err' =>'',
                'password_err' =>'',
                'confirm_password_err' => '',
            ];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            

                if(!empty($_POST)){
                    if(!empty($_POST['full_name'])){
                        $data['full_name'] = $_POST['full_name'];
                    } else {
                        $data['full_name_err'] = 'Enter Your Name';
                    }
                    if(!empty($_POST['email'])){
                        if($this->userModel->findUserByEmail($_POST['email'])){
                            $data['email_err'] = 'Email is taken';
                        } else {
                            $data['email'] = $_POST['email'];
                        }    
                    } else {
                        $data['email_err'] = 'Enter Your Email';
                    }


                    if(!empty($_POST['password'])){
                        if(strlen($_POST['password']) < MIN_PASS_LENGTH){
                            $data['password_err'] = 'Password length at least ' . MIN_PASS_LENGTH . ' characters';
                        } else {
                        $data['password'] = $_POST['password'];
                        }
                    } else {
                        $data['password_err'] = 'Enter Password';
                    }
                    if(!empty($_POST['confirm_password'])){
                        $data['confirm_password'] = $_POST['confirm_password'];
                    } else {
                        $data['confirm_password_err'] = 'Confirm Password';
                    }


                    if($data['password'] !== $data['confirm_password']){
                        $data['confirm_password_err'] = 'Passwords does not match';
                    }

                    //insert data into Data Base
                    if(empty($data['full_name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                        $this->userModel->register($data);
                        flash('user_register_success', 'Registration is successul');
                        redirect(['users', 'login']);
                    }

                    $this->loadView('register', $data);



                } else {
                }
            } else {
                
                $this->loadView('register', $data);
            }
        }

        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'remember' => isset($_POST['remember']),
                    'form_token' =>'',
                    
                    'email_err' =>'',
                    'password_err' =>'',
                ];
                if(empty($data['email'])){ 
                    $data['email_err'] = 'Enter email';
                } else {
                    if(!$this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'User not found';
                    }
                }

                if(empty($data['password'])) $data['password_err'] = 'Enter Your Password';

                              
                if(empty($data['email_err']) && empty($data['password_err'])){
                    //logging in
                    if($_POST['form_token'] == $_SESSION['token']){
                        if($loggedInUser = $this->userModel->login($data)){
                            //if user enter right password initializing session
                            $this->createUserSession($loggedInUser);
                            if($data['remember']){
                                //set cookies if checked 'remember'
                                $token = getToken();
                                if($this->userModel->setRememberToken($loggedInUser->id, $token)){
                                    setcookie('session_token', $token, time() + COOKIES_EXPIRE, APPROOT);
                                }
                            } else {
                                //if not checked 'remeber' erase token from DB
                                $this->userModel->setRememberToken($loggedInUser->id, '');
                            }
                        } else {
                            //if password entered wrong log data and issue error_message to user
                            $data['password_err'] = 'Check your password, please!';
                            $logData = [
                                'message' => $data['email'] . ' enter wrong password' . PHP_EOL,
                            ];
                            writeToLog($logData);
                            $this->token = getToken();
                            $_SESSION['token'] = getToken();
                            $data['token'] = $_SESSION['token'];
                            $this->loadView('login', $data);

                            return;
                        }
                        
                        redirect(['users', 'main']);
                    } else {
                        die('Tokens doesn`t match');
                    }
                }

                $this->loadView('login', $data);


            } else {
                $this->token = getToken();
                $_SESSION['token'] = getToken();
                $data['token'] = $_SESSION['token'];
                $this->loadView('login', $data);
            }

        }

        public function vkLogin(){
            $resType = 'code';
            $params = [
                'client_id' => CLIENT_ID,
                'redirect_uri' => URLROOT . '/index.php?page=users&action=vklogin',
                'response_type' => $resType,
                'v' => '5.131',
                'scope' => 'photos,offline',
        
            ];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

            }
            if(isset($_GET[$resType])){
                $sec_params = [
                    'client_id' => CLIENT_ID,
                    'client_secret' => PROTECTED_KEY,
                    'redirect_uri' => URLROOT . '/index.php?page=users&action=vklogin',
                    $resType => $_GET[$resType],
                ];
                if(!$token_file = file_get_contents('https://oauth.vk.com/access_token?' . urldecode(http_build_query($sec_params)))){
                    $error = error_get_last();
		            throw new Exception('HTTP request failed. Error: ' . $error['message']);
                }

                var_dump($token_file);

                $response = json_decode($token_file);
                if(isset($response->error)) {
                    throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
                }
                
                
                $user_id = $response->user_id;
                $request_params = [
                    'lang' => 'en',
                    'user_id' => $user_id,
                    'v' => '5.131',
                    'access_token' => $response->access_token,
                ];
                $get_params = http_build_query($request_params);
                $result = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params));
                $vk_User = new stdClass();
                $vk_User->full_name = $result -> response[0] -> first_name . ' ' . $result -> response[0] -> last_name;
                $vk_User->id = $response->user_id;
                $vk_User->email = 'vk';
                $vk_User->rights = ['view', 'vk'];
                $vk_User->created_at = 'vk';
                
                $this->createUserSession($vk_User);
                $_SESSION['user']['token'] = $response->access_token;
                
                redirect(['users','main']);
               

                // male request to vk for code
            } else {
                //make request to vk for app permissions access
                $request_url = VK_OAUTH_URL . '?' . urldecode(http_build_query($params));
                header('Location:' . $request_url);
            }
        }

        public function feedback(){
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $post = [
                    'begin' => '<message>' . PHP_EOL,
                    'name' => $_POST['name'] . PHP_EOL,
                    'email' => $_POST['email'] . PHP_EOL,
                    'message' => $_POST['feedback'] . PHP_EOL,
                    'end' => '</message>' . PHP_EOL,
                ];
                if(writeMessage($post)){
                    flash('feedback_success', 'Feedback accepted!');
                    redirect(['users', 'feedback']);
                } else {
                    flash('feedback_fail', 'Feedback sending failed!');
                    redirect(['users', 'feedback']);
                }

            } else {
                if(isset($_SESSION['user'])){
                    $data = [
                        'name' => $_SESSION['user']['name'],
                        'email' => $_SESSION['user']['email'],
                    ];
                }
                $this->loadView('feedback', $data);   
            }
        }

        public function profile(){
            if(isset($_SESSION['user'])){
                if(!in_array('vk', $_SESSION['user']['rights'])){
                    $loggedInUser = $this->userModel->getUserByEmail($_SESSION['user']['email']);
                    $data = [
                        'user id' => $loggedInUser->id,
                        'name' => $loggedInUser->full_name,
                        'email' => $loggedInUser->email,
                        'registration date' => $loggedInUser->created_at,
                    ];
                    $this->loadView('profile', $data);
                } else {
                    $this->loadView('profile');
                }

            } else {
                $this->loadView('login');
            }


        }

        public function createUserSession($user){
            $_SESSION['user']['name'] = $user->full_name;
            $_SESSION['user']['id'] = $user->id;
            $_SESSION['user']['email'] = $user->email;
            $_SESSION['user']['registration date'] = $user->created_at;
            $_SESSION['user']['rights'] = $user->rights;
        }

        public function logout(){
            if(isset($_COOKIE['session_token'])){
                setcookie('session_token', '', time());
                $this->userModel->setRememberToken($_SESSION['user']['id'], '');
            }
            unset($_SESSION['user']);
            session_destroy();
            redirect(['users', 'login']);
        }
    }