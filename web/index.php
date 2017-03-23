<?php
require_once("../vendor/autoload.php");

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$app            = new Application();

$app->get('/', function(Request $request) use ($app){
  return new JsonResponse("ok", 200);
});

$app->get('/user/{userid}', function(Request $request, $userid) use ($app){
  return new JsonResponse($userid, 200);
});

$app->run();
