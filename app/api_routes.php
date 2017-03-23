<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


$app->get('/', function(Request $request) use ($app){
  
  $q = $request->query->get("q");

  return new JsonResponse(["ok" => $q], 200);
});

$app->get('/film/{filmid}', function(Request $request, $filmid) use ($app){
  
  $sql = "SELECT * FROM films WHERE id_film = ?";
  $stmt = $app['db']->prepare($sql);
  $stmt->bindValue(1, $filmid);
  $stmt->execute();

  $user = $stmt->fetch();

  return new JsonResponse($user, 200);

});