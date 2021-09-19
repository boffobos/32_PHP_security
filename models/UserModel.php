<?php 
    class UserModel {
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function register($data){

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->db->prepare('INSERT INTO users (full_name, email, password) VALUES(:full_name, :email, :password)');
            $this->db->bind(':full_name', $data['full_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            if($this->db->execute()){
                $justCreatedUser = $this->getUserByEmail($data['email']);
                return $this->setUserRole($justCreatedUser->id, DEFAULT_USER_ROLE);
            }
        }

        /*    ------Works with roles------         */
        public function getUserRights($userId){
            $this->db->prepare('SELECT rights.name FROM rights
                                JOIN role_rights ON role_rights.right_name = rights.name
                                JOIN users ON role_rights.role_name = users.role
                                WHERE users.id = :user_id');
            $this->db->bind(':user_id', $userId);
            $rights = $this->db->selectAll();
            $arr = [];
            foreach($rights as $right){
                $arr[] = $right->name;
            }
            return $arr;
        }

        public function setUserRole($userId, $roleName){
            if($this->isRoleExist($roleName)){
                $this->db->prepare('UPDATE users SET role = :role_name WHERE id = :id');
                $this->db->bind(':role_name', $roleName);
                $this->db->bind(':id', $userId);
                return $this->db->execute();
            } else {
                return false;
            }
        }

        public function getRoleRights($roleName){
            $this->db->prepare('SELECT * FROM role_rights WHERE role_name = :role_rolename');
            $this->db->bind(':role_id', $roleName);
            return $this->db->selectAll();
        }

        public function isRoleExist($roleName){
            $this->db->prepare('SELECT * from roles WHERE name = :name');
            $this->db->bind(':name', $roleName);
            return $this->db->selectRow();
        }
        /*====================*/

        public function login($data){
            $user = $this->getUserByEmail($data['email']);
            if($user && password_verify($data['password'], $user->password)){
                return $user;
            } elseif (!password_verify($data['password'], $user->password)) {
               
                return false;
            }
            

        }

        public function findUserByEmail($email){
            $this->db->prepare('SELECT * FROM users WHERE email=:email');
            $this->db->bind(':email', $email);
            $this->db->execute();
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

        public function getUserByEmail($email){
            $this->db->prepare('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);
            $this->db->execute();
                       
            if($this->db->rowCount() > 0){
                $user = $this->db->selectRow();
                $user->rights = $this->getUserRights($user->id); 
                return $user;
            } else {
                return false;
            }
        }

 

        public function setRememberToken($id, $token){
            $this->db->prepare('UPDATE users 
            SET session_token = :token 
            WHERE id = :id');
            $this->db->bind(':token', $token);
            $this->db->bind(':id', $id);
            return $this->db->execute();
        }

        public function getUserByToken($token){
            $this->db->prepare('SELECT * FROM users WHERE session_token=:token');
            $this->db->bind(':token', $token);
            $this->db->execute();
            if($this->db->rowCount() > 0){
                $user = $this->db->selectRow();
                $user->rights = $this->getUserRights($user->id);
                return $user;
            } else {
                return false;
            }
        }
    }