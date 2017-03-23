<?php
require_once("../vendor/autoload.php");

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$app            = new Application();

$app->get('/', function(Request $request) use ($app){
  
  $q = $request->query->get("q");

  return new JsonResponse(["ok" => $q], 200);
});

$app->get('/user/{userid}', function(Request $request, $userid) use ($app){
  
  $user = [
    "id" => $userid,
    "pseudo" => "smwhr"
  ];

  return new JsonResponse($user, 200);

});

$app->run();
