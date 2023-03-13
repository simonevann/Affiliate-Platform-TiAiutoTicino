<?php
require_once('controllers/RedirectionController.php');

$id = ($id)?? null;

if($id){
    $controller = new RedirectionController($id);
    $controller->redirect();
}
