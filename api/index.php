<?php

require './config/database.php';
// require './sprints/index.php';
require './router/index.php';

// $conn = new Connection();
// $db = $conn->getConnection();



$router = new Router();

// Respond to a home page request
$router->respond("GET", "/", function() {
  echo 'Root';
});

// Respond to a delete request at the supplied URI
$router->respond("GET", "/sprint/all", function() {
   require './models/SprintModel.php';

   $sprintModel = new SprintModel();
   $sprintModel->getAll();
});

$router->respond("GET", "/card/all", function() {
    require './models/CardModel.php';
 
    $cardModel = new CardModel();
    $cardModel->getAll();
});

$router->respond("GET", "/lane/all", function() {
    require './models/LaneModel.php';
 
    $cardModel = new LaneModel();
    $cardModel->getAll();
});