<?php
require_once('models/Db.php');
/**
 * Model dei link e delle operazione CRUD
 */
class Link extends Db{

    public $shortLink;
    public $destination;
    public $linkId;
    public $only_api_use;

    public function __construct()
    {
        parent::__construct();
    }

    //get all links, joined with the user table and log table
    public function getAllLinks(){
        $sql = "SELECT link.id, link.short_link, link.destination, link.date_creation, link.user_id, link_value.value AS link_value, user.username, link_value.title AS link_value_title, COUNT(log.link_id) AS clicks FROM link LEFT JOIN user ON link.user_id = user.id LEFT JOIN log ON link.id = log.link_id JOIN link_value ON link.link_value = link_value.id GROUP BY link.id";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $links = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $links;
    }

    //get link by user id
    public function getLinksByUserId($id, $limit){
        $sql = "SELECT link.id, link.short_link, link.destination, link.date_creation, link.user_id, link.link_value, link_value.title AS link_value_title, user.username, COUNT(log.link_id) AS clicks FROM link LEFT JOIN user ON link.user_id = user.id LEFT JOIN log ON link.id = log.link_id LEFT JOIN link_value ON link.link_value = link_value.id WHERE link.user_id = :id GROUP BY link.id LIMIT " . $limit . " OFFSET 0";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':id', $id);
        //$stmt->bindParam(':limitres', $limit);
        $stmt->execute();
        $links = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $links;
    }

    //Get the destination url from the short url, if the short url doesn't exist, return false
    public function getDestination($shortUrl){
        $sql = "SELECT destination FROM link WHERE short_link = :shortUrl";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':shortUrl', $shortUrl);
        $stmt->execute();
        $destination = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$destination){
            return false;
        }
        return $destination['destination'];
    }

    //Get link id from the short url
    public function getLinkId($shortUrl){
        $sql = "SELECT id FROM link WHERE short_link = :shortUrl";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':shortUrl', $shortUrl);
        $stmt->execute();
        $linkId = $stmt->fetch(PDO::FETCH_ASSOC);
        return $linkId['id'];
    }

    //Get the only_api_use value from the short url
    public function getOnlyApiUse($shortUrl){
        $sql = "SELECT only_api_use FROM link_value JOIN link ON link.link_value = link_value.id WHERE link.short_link = :shortUrl";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':shortUrl', $shortUrl);
        $stmt->execute();
        $onlyApiUse = $stmt->fetch(PDO::FETCH_ASSOC);
        return $onlyApiUse['only_api_use'];
    }

    //Get the user id from the short url
    public function getUserId($shortUrl){
        $sql = "SELECT user_id FROM link WHERE short_link = :shortUrl";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':shortUrl', $shortUrl);
        $stmt->execute();
        $userId = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userId['user_id'];
    }

    //Create a random string for the short url
    public function generateShortUrl(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //Create a link
    public function createLink($userId, $destination, $linkValue){
        $shortUrl = $this->generateShortUrl();
        //get the date of creation
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO link (short_link, destination, user_id, date_creation, link_value) VALUES (:shortUrl, :destination, :userId, :date_creation, :linkValue)";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':shortUrl', $shortUrl);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':date_creation', $date);
        $stmt->bindParam(':linkValue', $linkValue);
        $stmt->execute();
    }

    //get the number of links
    public function getLinksNumber(){
        $sql = "SELECT COUNT(id) AS total FROM link";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    //get the number of links by user id
    public function getLinksNumberByUserId($id){
        $sql = "SELECT COUNT(id) AS total FROM link WHERE user_id = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    //get the number of clicks for every link
    public function getClicksPerLink(){
        $sql = "SELECT link.id, link.short_link, link.destination, link.date_creation, link.user_id, link.link_value, user.username, COUNT(log.link_id) AS clicks FROM link LEFT JOIN user ON link.user_id = user.id LEFT JOIN log ON link.id = log.link_id GROUP BY link.id";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $links = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $links;
    }

    //get the number of clicks for every link by user id
    public function getClicksPerLinkByUserId($id){
        $sql = "SELECT link.id, link.short_link, link.destination, link.date_creation, link.user_id, link.link_value, user.username, COUNT(log.link_id) AS clicks FROM link LEFT JOIN user ON link.user_id = user.id LEFT JOIN log ON link.id = log.link_id WHERE user_id = :id GROUP BY link.id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $links = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $links;
    }

    //get the number of clicks for a link
    public function getClicksNumber($id){
        $sql = "SELECT COUNT(link_id) AS total FROM log WHERE link_id = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    //get the number of all links
    public function getAllLinksNumber(){
        $sql = "SELECT COUNT(id) AS total FROM link";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    //get the last link of a user
    public function getLastLinkOfUser($id){
        $sql = "SELECT * FROM link WHERE user_id = :id ORDER BY id DESC LIMIT 1";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $link = $stmt->fetch(PDO::FETCH_ASSOC);
        return $link;
    }
}