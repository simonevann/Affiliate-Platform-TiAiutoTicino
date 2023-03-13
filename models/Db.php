<?php
class Db extends PDO {
    private $uname;
    private $passwd;
    private $hostname;
    private $dbname;
    public function __construct()
    {
        $this->uname = "root";
        $this->passwd = "";
        $this->hostname = "127.0.0.1";
        $this->dbname = "ti-aiuto-ticino";
        try {
            parent::__construct('mysql:host=' . $this->hostname . ';dbname=' . $this->dbname, $this->uname, $this->passwd);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
   }