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

$app->get('/films', function(Request $request) use ($app){
  
  $limit = $request->query->get("limit", 10);
  $page = $request->query->get("page", 1);
  $offset = ($page - 1) * $limit;

  $qb = new QueryBuilder($app['db']);
  $qb->select("*")
          ->from("film")
          ->setMaxResults($limit)
          ->setFirstResult($offset)
          ->orderBy("annee_production", "DESC")
          ;
  $res = $qb->execute();
  $films = $res->fetchAll();

  return new JsonResponse($films, 200);

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