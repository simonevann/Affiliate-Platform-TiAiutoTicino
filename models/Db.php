<?php
/**
 * Classe base per la connessione al database
 */
class Db extends PDO {
    private $uname;
    private $passwd;
    private $hostname;
    private $dbname;
    
    public function __construct()
    {
        $this->uname = "";
        $this->passwd = "";
        $this->hostname = "";
        $this->dbname = "";
        try {
            parent::__construct('mysql:host=' . $this->hostname . ';dbname=' . $this->dbname, $this->uname, $this->passwd);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
   }
