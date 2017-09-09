<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/dbconnect.php';


$app = new \Slim\App([
  'settings' => [
    'determineRouteBeforeAppMiddleware' => true,
  'displayErrorDetails' => true,
      'addContentLengthHeader' => false,
  ],
]);
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/users', function(Request $request,Response $response){
    //echo 'FFF';
    $sql = "SELECT * FROM users";

   try{
    $db = new DB();

    $db->connect();

    $stmt = $db->query($sql);
    var_dump($stmt);
    /*$users = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db =null;
    echo json_encode($users);*/
  }catch(PDOException $e){

    echo $e->getMessage();

  }

});

$app->run();

 ?>
