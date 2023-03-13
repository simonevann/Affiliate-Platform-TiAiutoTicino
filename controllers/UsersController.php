<?php

class UsersController{

    private $user;

    public function __construct(){
        $this->user = new User();
    }
    public function index(){
        return $this->user->getAllUsers();
    }

    public function show($id){
        return $this->user->getUserById($id);
    }


}