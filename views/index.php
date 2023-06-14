<?php
require_once('controllers/RedirectionController.php');

$id = ($id)?? null;

if($id){
    $controller = new RedirectionController($id);
    $controller->redirect();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TiAiutoTicino Affiliate Platform</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="TiAiutoTicino Affiliate Platform">
    <link href="https://fonts.cdnfonts.com/css/lexend-deca" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            font-family: "Lexend", Sans-serif;
            background-image: url('./assets/ticino-bk.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }
    </style>
  </head>
    <body class="container d-flex p-3 justify-content-center align-items-center">
        <main class="w-50 px-3 bg-light d-flex flex-column">
            <img class="w-50 m-auto" src="./assets/Logo-OGimage.png" alt="TiAiutoTicino Logo" >
            <h1>TiAiutoTicino Affiliate Platform</h1>
            <a href="https://tiaiutoticino.ch/" class="btn btn-lg btn-primary">Scopri di più</a>
            </p>
        </main>
    </body>
</html>
