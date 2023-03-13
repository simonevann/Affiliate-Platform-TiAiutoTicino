<?php 
require_once('models/Log.php');
require_once('models/Link.php');

class RedirectionController {
    
    public $link;
    public function __construct($shortLink = null)
    {
        $this->link = new Link();
        $this->link->shortLink = $shortLink;
        $this->link->linkId = $this->link->getLinkId($this->link->shortLink);
    }

    public function redirect(){
        $log = new Log();
        $log->createLog($this->link->linkId);
        $destination = $this->link->getDestination($this->link->shortLink);
        //redirect to the destination url
        header('Location: ' . $destination);
    }

}