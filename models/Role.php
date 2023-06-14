<?php
require_once('models/Db.php');

/**
 * Model per la gestione dei ruoli della piattaforma
 */

class Role extends Db {
    
        public function __construct()
        {
            parent::__construct();
        }
    
        //get all items from the role table
        public function getAllRoles(){
            $sql = "SELECT * FROM user_role";
            $stmt = $this->prepare($sql);
            $stmt->execute();
            $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $roles;
        }
    
        //get the role id from the role name
        public function getRoleId($roleName){
            $sql = "SELECT id FROM user_role WHERE title = :roleName";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(':roleName', $roleName);
            $stmt->execute();
            $roleId = $stmt->fetch(PDO::FETCH_ASSOC);
            return $roleId['id'];
        }
    
        //get the role from the role id
        public function getRolebyId($roleId){
            $sql = "SELECT title FROM user_role WHERE id = :roleId";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(':roleId', $roleId);
            $stmt->execute();
            $roleName = $stmt->fetch(PDO::FETCH_ASSOC);
            return $roleName['title'];
        }
}