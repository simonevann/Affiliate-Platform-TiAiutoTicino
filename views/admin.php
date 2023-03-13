<?php
 //include the controller
 require_once('controllers/AdminController.php');
 require_once('controllers/LoginController.php');
 
 $isLogin = LoginController::isLoggedIn();
 $page = ($page)??'dashboard';
 $page = ($isLogin)?$page:'login';
 $id = ($id)?? null;
 if($isLogin){
     require_once('views/template/header.php');
 }
 //create an instance of the controller
 $controller = new AdminController($page, $id);
 //render the view
 $controller->render();
?>