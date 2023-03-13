<?php
require_once('models/Db.php');

class User extends Db
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($username, $password)
    {
        $hash = hash('sha256', $password);
        $sql = "SELECT id, first_name, last_name, role FROM user WHERE username = :username AND password = :password AND active = 1";
        $stmt = $this->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $hash]);
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
}