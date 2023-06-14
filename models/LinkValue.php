<?php
include_once('models/Db.php');

class LinkValue extends Db {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all link_values
     * @return array
     */
    public function getAllLinkValues(){
        $sql = "SELECT * FROM link_value";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $linkValues = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $linkValues;
    }

    /**
     * Get the link_value id from the link_value name
     * @param string $linkValueName
     * @return int
     */
    public function getLinkValueId($linkValueName){
        $sql = "SELECT id FROM link_value WHERE title = :linkValueName";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':linkValueName', $linkValueName);
        $stmt->execute();
        $linkValueId = $stmt->fetch(PDO::FETCH_ASSOC);
        return $linkValueId['id'];
    }

    /**
     * Get the link_value name from the link_value id
     * @param int $linkValueId
     * @return string
     */
    public function getLinkValueName($linkValueId){
        $sql = "SELECT title FROM link_value WHERE id = :linkValueId";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':linkValueId', $linkValueId);
        $stmt->execute();
        $linkValueName = $stmt->fetch(PDO::FETCH_ASSOC);
        return $linkValueName['title'];
    }
    
}