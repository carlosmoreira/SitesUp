<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/13/15
 * Time: 7:43 PM
 */


require "vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Pool;


$client = new Client();

$sites = $client->get("http://www.fierceenigma.com/sitesapp/sites/websites")->json();

$requests = null;

foreach ($sites as $site) {
    $requests[] = $client->createRequest("GET", $site['Site']['url']);
}

$results = Pool::batch($client, $requests);

if(!empty($results)){
    foreach ($results as $res) {
        echo $res->getEffectiveUrl() . " " . $res->getStatusCode() . "<br >";
    }
}






