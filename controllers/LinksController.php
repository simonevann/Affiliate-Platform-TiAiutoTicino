<?php
require_once('models/Link.php');
class LinksController extends AdminController{

    private $link;

    public function __construct(){
        $this->link = new Link();
    }
   
    public function index(){
        return $this->link->getAllLinks();
    }

    public function showUsersLink($id){
        $link = new Link();
        return $this->link->getLinksByUserId($id);
    }
}