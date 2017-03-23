<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\DBAL\Query\QueryBuilder;


$app->get('/', function(Request $request) use ($app){
  
  $q = $request->query->get("q");

  return new JsonResponse(["ok" => $q], 200);
});

$app->get('/film/{filmid}', function(Request $request, $filmid) use ($app){
  

  $qb = new QueryBuilder($app['db']);
  $qb->select("*")
          ->from("films")
          ->andWhere("id_film = :id_film")
          ->setParameter("id_film", $filmid);
  $res = $qb->execute();
  $film = $res->fetch();

  return new JsonResponse($film, 200);

});