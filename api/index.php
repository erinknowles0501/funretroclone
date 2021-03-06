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






$router->respond("GET", "/lane/all", function() {
    require './models/LaneModel.php';
 
    $laneModel = new LaneModel();
    $laneModel->getAll();
});

$router->respond("POST", "/lane/create", function() {
    require './models/LaneModel.php';

    $data = json_decode(file_get_contents('php://input'));

    $laneModel = new LaneModel();
    $laneModel->createNew($data->title, $data->color);
});


$router->respond("POST", "/lane/update", function() {
  require './models/LaneModel.php';

  $data = json_decode(file_get_contents('php://input'));

  $laneModel = new LaneModel();
  $laneModel->update($data->id, $data->title, $data->color);
});

$router->respond("POST", "/lane/delete", function() {
  require './models/LaneModel.php';

  $id = json_decode(file_get_contents('php://input'));

  $laneModel = new LaneModel();
  $laneModel->destroy($id);
});





$router->respond("GET", "/card/all", function() {
  require './models/CardModel.php';

  $cardModel = new CardModel();
  $cardModel->getAll();
});

$router->respond("POST", "/card/create", function() {
require './models/CardModel.php';

$data = json_decode(file_get_contents('php://input'));

$cardModel = new CardModel();
$cardModel->createNew($data->text, $data->sprintId, $data->laneId);
});

$router->respond("POST", "/card/update", function() {
  require './models/CardModel.php';

  $data = json_decode(file_get_contents('php://input'));

  $cardModel = new CardModel();
  $cardModel->update($data->id, $data->text);
});

$router->respond("POST", "/card/delete", function() {
  require './models/CardModel.php';

  $id = json_decode(file_get_contents('php://input'));

  $cardModel = new CardModel();
  $cardModel->destroy($id);
});