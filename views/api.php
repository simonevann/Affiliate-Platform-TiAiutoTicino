<?php
header('Content-Type: application/json; charset=utf-8');

require_once('controllers/ApiController.php');
//$isAuth = ApiController::apiAuth($user,$pass);
$isAuth = 1;
$endpoint = ($endpoint)?? null;
$id = ($id)?? null;
$attr1 = ($attr1)?? null;
//$page = ($isLogin)?$page:'login';

if($isAuth){
    $api = new ApiController($endpoint, $id);

    //if $endpoint is not set, return error
    if(!isset($endpoint)){
        $response = array(
            'status' => 'error',
            'message' => 'Endpoint not set'
        );
        echo json_encode($response);
        exit;
    }   
    //if request is a GET request
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        //if $endpoint is user and $id is set, return user data, else return all users
        if($endpoint == 'user'){
            if(isset($id)){
                $user = $api->apiGetUserById($id);
                echo json_encode($user);
            }else{
                $users = $api->apiGetAllUsers();
                echo "all users";
                echo json_encode($users);
            }
            exit;
        }
        if($endpoint == 'link'){
            if(isset($id)){
                $links = $api->apiGetLinksByUserId($id, 10);
                echo json_encode($links);
            }else{
                $links = $api->apiGetAllLinks();
                echo json_encode($links);
            }
            exit;
        }
        if($endpoint == 'score'){
            if(isset($id)){
                $links = $api->apiGetScoreboardByUser($id, 10);
                echo json_encode($links);
            }else{
                $links = $api->apiGetScoreboard();
                echo json_encode($links);
            }
            exit;
        }
    }

    //if request is a POST request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($endpoint == 'user'){
            //get the json data in body of the request
            $data = json_decode(file_get_contents('php://input'), true);
            //create the user
            $username = $data['username'];
            $password = $data['password'];
            $email = $data['email'];
            $ext_id = $data['ext_id'];
            $user = $api->apiCreateUser($attr1);
            echo json_encode($user);
            exit;
        }
        if($endpoint == 'link'){
            $destination = $_POST['destination'];
            $linkValue = $_POST['linkValue'];
            $link = $api->apiCreateLink($id, $destination, $linkValue);
            echo json_encode($link);
            exit;
        }
    }
} else {
    echo 'Not authorized';
}