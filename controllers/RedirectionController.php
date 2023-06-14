<?php 
require_once('models/Log.php');
require_once('models/Link.php');

/**
 * Questo controller gestisce il reindirizzamento di chi utilizza uno shortlink
 */

class RedirectionController {
    
    public $link;
    public $userId;

    public function __construct($shortLink = null)
    {
        $this->link = new Link();
        $this->link->shortLink = $shortLink;
        $this->link->linkId = $this->link->getLinkId($this->link->shortLink);
        $this->link->only_api_use = $this->link->getOnlyApiUse($this->link->shortLink);
        $this->userId = $this->link->getUserId($this->link->shortLink);
    }

    public function redirect(){
        $log = new Log();
        if($this->link->only_api_use == 0){
            $log->createLog($this->link->linkId);
        }
        $destination = $this->link->getDestination($this->link->shortLink);
        //create the targer url, with the destination and the following parameters
        $destination .= '?utm_source=affiliateplatform&utm_medium=link&utm_campaign=affiliate&apuid=' . $this->userId;
        //redirect to the destination url
        header('Location: ' . $destination);
    }

}