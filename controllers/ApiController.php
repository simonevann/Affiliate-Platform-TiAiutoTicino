<?php
require_once('models/User.php');
require_once('models/Link.php');
require_once('models/Scoreboard.php');

/**
 * Controller per la gestione delle chiemate api
 */

class ApiController{

    private $apiRole = 3;

    function apiAuth($username, $password){
        $user = new User();
        $login = $user->login($username, $password. $this->apiRole);
        if($login){
            return true;
        }else{
            return false;
        }
    }

    function apiGetAllUsers(){
        $user = new User();
        $users = $user->getAllUsers();
        return $users;
    }

    function apiGetUserById($id){
        $user = new User();
        $user = $user->getUserById($id);
        return $user;
    }

    //create a new user, and return the new user data witout password
    function apiCreateUser($firstName, $lastName, $username){
        $user = new User();
        $password = $user->generatePassword();
        $user->createUser($firstName, $lastName, $username, $password, $this->apiRole);
        return $user;
    }

    //create a link for a user, and retur the short url
    function apiCreateLink($userId, $destination, $linkValue){
        $link = new Link();
        $link->createLink($userId, $destination, $linkValue);
        //get the last link created by the user
        $lastLink = $link->getLastLinkOfUser($userId);
        return $lastLink;
    }

    //get all links of a user
    function apiGetLinksByUserId($userId, $limit){
        $link = new Link();
        $links = $link->getLinksByUserId($userId, $limit);
        return $links;
    }

    //get all links
    function apiGetAllLinks(){
        $link = new Link();
        $links = $link->getAllLinks();
        return $links;
    }

    //get the scoreboard
    function apiGetScoreboard(){
        $scoreboard = new Scoreboard();
        $scoreboard = $scoreboard->getScoreboardByMonth();
        return $scoreboard;
    }

    //get the scoreboard by month of the user
    function apiGetScoreboardByUser($userId){
        $scoreboard = new Scoreboard();
        $scoreboard = $scoreboard->getScoreboardByUser($userId);
        return $scoreboard;
    }


}