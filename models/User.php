<?php
require_once('models/Db.php');

/**
 * Model per la gestione degli utenti e le operazioni CRUD
 */

class User extends Db
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($username, $password, $role = 1)
    {
        $hash = hash('sha256', $password);
        $sql = "SELECT id, first_name, last_name, role FROM user WHERE username = :username AND password = :password AND role = :role AND active = 1";
        $stmt = $this->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $hash, 'role' => $role]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION['user'] = $user;
            return true;
        } else {
            return false;
        }
    }

    public function getUser()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            return false;
        }
    }

    //get all users, joined with the role table
    public function getAllUsers()
    {
        $sql = "SELECT user.id, user.first_name, user.last_name, user.username, r.title as role  FROM user JOIN user_role r ON (r.id = user.role)";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getUserById($id)
    {
        $sql = "SELECT id, first_name, last_name, username, role FROM user WHERE id = :id";
        $stmt = $this->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    //get users number
    public function getUsersNumber()
    {
        $sql = "SELECT COUNT(id) AS total FROM user";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        return $users['total'];
    }

    //Generate random password
    public static function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }

    //create a new user, with the argument of the user's first name, last name, username, external_if, password and role. retu
    public function createUser($username, $external_id, $password, $role, $active = 0, $first_name = '', $last_name = '')
    {
        $hash = hash('sha256', $password);
        $sql = "INSERT INTO user (first_name, last_name, username, external_id, password, role, active) VALUES (:first_name, :last_name, :username, :external_id, :password, :role, :active)";
        $stmt = $this->prepare($sql);
        $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'username' => $username, 'external_id' => $external_id, 'password' => $hash, 'role' => $role, 'active' => $active]);
        //return the new user id
        return $this->getLastUser();
    }

    //get the last insered user
    public function getLastUser()
    {
        $sql = "SELECT id, first_name, last_name, username, role FROM user ORDER BY id DESC LIMIT 1";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }


}