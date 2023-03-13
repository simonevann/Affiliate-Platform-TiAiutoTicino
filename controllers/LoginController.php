<?php
require_once('models/User.php');
class LoginController{
    //check if user is logged in and return a boolean
    public static function isLoggedIn(){
        if(isset($_SESSION['user'])){
            return true;
        }else{
            return false;
        }
    }

    public function login($username, $password){
        $user = new User();
        $login = $user->login($username, $password);
        if($login){
            header('Location: /admin');
        }else{
            header('Location: /admin/login');
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        header('Location: /admin/login');
    }
}