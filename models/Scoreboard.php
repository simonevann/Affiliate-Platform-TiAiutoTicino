<?php
require_once('Db.php');

/**
 * Model per la gestione della pagina delle classifiche e i punteggi degli utenti
 */

class Scoreboard extends Db {
    
    // all the record of the log table, joined with the user table and the link table and link_value table, to retrive sore of the day
    public function getTotalScoreboard(){
        //$sql = "SELECT link_id, short_link, destination, date_creation, user_id, COUNT(log.id) AS clicks, link_value.value, COUNT(log.id) * link_value.value AS points  FROM log JOIN link ON log.link_id = link.id JOIN link_value ON link.link_value = link_value.id GROUP BY link_id, short_link, destination, date_creation, user_id, link_value.value ORDER BY points DESC";
        $sql="SELECT link_id, user.username, short_link, destination, date_creation, user_id, COUNT(log.id) AS clicks, link_value.value, COUNT(log.id) * link_value.value AS points  FROM log JOIN link ON log.link_id = link.id JOIN link_value ON link.link_value = link_value.id JOIN user ON link.user_id = user.id GROUP BY link_id, short_link, destination, date_creation, user_id, user.username, link_value.value ORDER BY points DESC";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $scoreboard = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $scoreboard;
    }

    // all the record of the log table, joined with the user table and the link table and link_value table, to retrive sore of the day
    public function getScoreboardByDate($date){
        $sql = "SELECT link_id, short_link, destination, date_creation, user_id, COUNT(log.id) AS clicks, link_value.value, COUNT(log.id) * link_value.value AS points  FROM log JOIN link ON log.link_id = link.id JOIN link_value ON link.link_value = link_value.id WHERE date_creation LIKE :date GROUP BY link_id, short_link, destination, date_creation, user_id, link_value.value ORDER BY points DESC";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $scoreboard = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $scoreboard;
    }

    // all the record of the log table, joined with the user table and the link table and link_value table, to retrive sore of the last week
    public function getScoreboardByWeek(){
        $sql = "SELECT link_id, user.username, short_link, destination, date_creation, user_id, COUNT(log.id) AS clicks, link_value.value, COUNT(log.id) * link_value.value AS points FROM log JOIN link ON log.link_id = link.id JOIN link_value ON link.link_value = link_value.id JOIN user ON link.user_id = user.id WHERE date_creation BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() GROUP BY link_id, user.username, short_link, destination, date_creation, user_id, link_value.value ORDER BY points DESC";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $scoreboard = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $scoreboard;
    }

    // all the record of the log table, joined with the user table and the link table and link_value table, to retrive sore of the last month
    public function getScoreboardByMonth(){
        $sql = "SELECT link_id, user.username, short_link, destination, date_creation, user_id, COUNT(log.id) AS clicks, link_value.value, COUNT(log.id) * link_value.value AS points FROM log JOIN link ON log.link_id = link.id JOIN link_value ON link.link_value = link_value.id JOIN user ON link.user_id = user.id WHERE date_creation BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() GROUP BY link_id, user.username, short_link, destination, date_creation, user_id, link_value.value ORDER BY points DESC";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $scoreboard = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $scoreboard;
    }

    // all the record of the log table of a user, joined with the user table and the link table and link_value table, to retrive sore of the last month
    public function getScoreboardByUser($user_id){
        $sql = "SELECT link_id, short_link, destination, date_creation, user_id, COUNT(log.id) AS clicks, link_value.value, COUNT(log.id) * link_value.value AS points FROM log JOIN link ON log.link_id = link.id JOIN link_value ON link.link_value = link_value.id JOIN user ON link.user_id = user.id WHERE user_id = :user_id GROUP BY link_id, user.username, short_link, destination, date_creation, user_id, link_value.value ORDER BY points DESC";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $scoreboard = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $scoreboard;
    }





}

