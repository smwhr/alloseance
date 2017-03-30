<?php
require_once(__DIR__."/../vendor/autoload.php");

use \GuzzleHttp\Client;

$client = new Client(['base_uri' => "http://localhost:8000"]);

// $reponse = $client->request("GET", "/", ["query" => ["q" =>  "le respect"]]);
// // $reponse = $client->get("/", ["query" => ["q" =>  "le respect"]]);

// var_dump($reponse->getStatusCode());
// $body_raw = $reponse->getBody();
// $body = json_decode($body_raw);
// var_dump($body);


$reponse = $client->request("GET", "/film/22");
$film = json_decode($reponse->getBody());
var_dump($film->duree_minutes);


$reponse = $client->request("PUT", "/film/22", [
  "form_params" => [
          "id_genre" => 2,
          "titre"    => "The Double Life of Veronique",
          "duree_minutes" => 98
      ]
  ]);

$updated = json_decode($reponse->getBody());
var_dump($updated);


$reponse = $client->request("GET", "/film/22");
$film = json_decode($reponse->getBody());
var_dump($film->duree_minutes);