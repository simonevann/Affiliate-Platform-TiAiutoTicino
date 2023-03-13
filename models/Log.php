<?php
require_once('models/Db.php');

class Log extends Db{

    public function __construct()
    {
        parent::__construct();
    }

    //crete a static method to create a log with the following parameters $link_id, $date
    public static function createLog($linkId){
        $db = new Db();
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO log (link_id, click_date) VALUES (:linkId, :click_date)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':linkId', $linkId);
        $stmt->bindParam(':click_date', $date);
        $stmt->execute();
    }

    //get all logs of a user, joined with the link table
    public function getLogsByUserId($id){
        $sql = "SELECT log.id, log.link_id, log.click_date, link.short_link FROM log LEFT JOIN link ON log.link_id = link.id WHERE link.user_id = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $logs;
    }

    //get all logs, joined with the link table
    public function getAllLogs(){
        $sql = "SELECT log.id, log.link_id, log.click_date, link.short_link, link.destination, link.user_id FROM log LEFT JOIN link ON log.link_id = link.id";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $logs;
    }

    //get the number of click today
    public function getClicksToday(){
        $date = date('Y-m-d');
        $sql = "SELECT COUNT(id) AS total FROM log WHERE click_date LIKE :date";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $logs = $stmt->fetch(PDO::FETCH_ASSOC);
        return $logs['total'];
    }

    //get the number of click per mounth, the last twelve mounths
    public function getClicksPerMounth(){
        $sql = "SELECT COUNT(id) AS total, MONTH(click_date) AS month, YEAR(click_date) AS year FROM log GROUP BY month, year ORDER BY year DESC, month DESC LIMIT 12";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $logs;
    }

}