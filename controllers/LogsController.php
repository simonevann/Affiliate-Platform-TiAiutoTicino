<?php
require_once('models/Log.php');

class LogsController{

    public $log;

    public function __construct(){
        $this->log = new Log();
    }

    public function index(){
        return $this->log->getAllLogs();
    }

}