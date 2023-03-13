<?php
require_once('Db.php');

class Scoreboard extends Db {
    
    // all the record of the log table, joined with the user table and the link table and link_value table, to retrive sore of the day
    public function getScoreboard(){
        $sql = "SELECT log.click_date, log.link_id, link.user_id, user.username, link.short_link, COUNT(LOG.id) as clicks, link_value.value, COUNT(LOG.id) * link_value.value AS total_points FROM log LEFT JOIN link ON log.link_id = link.id LEFT JOIN user ON link.user_id = user.id  LEFT JOIN link_value ON link.link_value = link_value.id  GROUP BY click_date, username, link_id, user_id, link_value.value, short_link";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $scoreboard = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $scoreboard;
    }


}

