<?php
require_once('models/User.php');
require_once('models/Log.php');
require_once('models/Link.php');

class DashboardController{

    private $user;
    private $log;
    private $link;

    public function __construct(){
        $this->user = new User();
        $this->log = new Log();
        $this->link = new Link();
    }

    //get user number
    public function getUserNumber(){
        return $this->user->getUsersNumber();
    }

    //get link number
    public function getLinkNumber(){
        return $this->link->getLinksNumber();
    }

    //get log of today
    public function getClicksToday(){
        return $this->log->getClicksToday();
    }

    //get log of the last twelve months, and convert it to a json format
    public function getClicksPerMounth(){
        $logs = $this->log->getClicksPerMounth();
        $data = [];
        foreach($logs as $log){
            $data[] = [
                'month' => $log['month'],
                'year' => $log['year'],
                'total' => $log['total']
            ];
        }
        return json_encode($data);
    }

}