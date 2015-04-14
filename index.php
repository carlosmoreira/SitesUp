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


class SitesUp{
    private $client;
    private $requestSites;

    /*
     * Inject Guzzle Client
     * */
    public function __construct(GuzzleHttp\Client $client){
        $this->client = $client;
    }

    public function setRequestSites(array $sites = null){
        foreach($sites as $site){
            $this->requestSites[] = $this->client->createRequest("GET", $site);
        }
    }

    public function checkSites(){
        if(empty($this->requestSites)){
            throw new exception("Please pass some urls to check");
        }
        $results = null;
        $requests = Pool::batch($this->client, $this->requestSites);
        foreach($requests as $req){
            $results[] = array('url'=> $req->getEffectiveUrl() , 'statusCode'=> $req->getStatusCode());
        }
        return $results;
    }
}

$sitesUp = new SitesUp(new Client());
$sitesUp->setRequestSites([
    "http://www.google.com",
    "http://www.cbs.com"
]);
var_dump($sitesUp->checkSites());
