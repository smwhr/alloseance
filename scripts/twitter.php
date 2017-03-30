<?php
require_once(__DIR__."/../vendor/autoload.php");

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

$stack = HandlerStack::create();

$oauth = new Oauth1([
    'consumer_key'    => '',
    'consumer_secret' => '',
    'token'           => '',
    'token_secret'    => ''
]);
$stack->push($oauth);

$client = new Client(['base_uri' => 'https://api.twitter.com/1.1/', 
                      'handler' => $stack
                     ]);



$res = $client->get('statuses/home_timeline.json', ['auth' => 'oauth']);
$flux = json_decode($res->getBody()->__toString());

var_dump($flux);