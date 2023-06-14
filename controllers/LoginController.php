<?php
require_once('models/User.php');
/**
 * Controller per la gestione del login
 */

class LoginController{
    //Controlla che l'utente sia loggato
    public static function isLoggedIn(){
        if(isset($_SESSION['user'])){
            return true;
        }else{
            return false;
        }
    }

    //Fa il login, se l'utente è già loggato lo reindirizza alla dashboard, altrimenti lo reindirizza al login
    public function login($username, $password){
        $user = new User();
        $login = $user->login($username, $password);
        if($login){
            header('Location: /admin');
        }else{
            header('Location: /admin/login');
        }
    } 

    //Fa il logout
    public function logout(){
        unset($_SESSION['user']);
        header('Location: /admin/login');
    }
}