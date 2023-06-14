<?php
require_once('models/Role.php');
/**
 * Controller per la gestione della pagina dei ruoli
 */
class RolesController{
    public $role;

    public function __construct()
    {
        $this->role = new Role();
    }

    //create index function to get all roles
    public function index()
    {
        return $this->role->getAllRoles();
    }

    //create show function to get role by id
    public function show($id)
    {
        return $this->role->getRolebyId($id);
    }
}