<?php
require_once('models/LinkValue.php');
/**
 * Controller per la gestione della pagina del punteggio dei link
 */
class LinksValueController{

    public $linkValue;

    public function __construct(){
        $this->linkValue = new LinkValue();
    }
    // function to get all link values
    public function index(){
        return $this->linkValue->getAllLinkValues();
    }

    //show function to get link value by id
    public function show($id){
        return $this->linkValue->getLinkValueName($id);
    }

}