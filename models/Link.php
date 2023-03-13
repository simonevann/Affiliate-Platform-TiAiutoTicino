<?php
require_once('models/Db.php');
class Link extends Db{

    public $shortLink;
    public $destination;
    public $linkId;

    public function __construct()
    {
        parent::__construct();
    }

    //get all links, joined with the user table and log table
    public function getAllLinks(){
        $sql = "SELECT link.id, link.short_link, link.destination, link.date_creation, link.user_id, link.link_value, user.username, COUNT(log.link_id) AS clicks FROM link LEFT JOIN user ON link.user_id = user.id LEFT JOIN log ON link.id = log.link_id GROUP BY link.id";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $links = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $links;
    }

    //get link by user id
    public function getLinksByUserId($id){
        $sql = "SELECT link.id, link.short_link, link.destination, link.date_creation, link.user_id, link.link_value, user.username, COUNT(log.link_id) AS clicks FROM link LEFT JOIN user ON link.user_id = user.id LEFT JOIN log ON link.id = log.link_id WHERE user_id = :id GROUP BY link.id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':id', $id);
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
    public function createLink($destination, $userId){
        $shortUrl = $this->generateShortUrl();
        $sql = "INSERT INTO link (short_link, destination, user_id) VALUES (:shortUrl, :destination, :userId)";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':shortUrl', $shortUrl);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':userId', $userId);
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
}