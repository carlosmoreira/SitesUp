<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/13/15
 * Time: 7:43 PM
 */


require "vendor/autoload.php";

use GuzzleHttp\Client;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;

$message = new Message();

$message->setFrom('Info <info@example.com>')
    ->addTo('moreira.carlos09@gmail.com')
    ->setSubject('Order Confirmation')
    ->setBody("Hello, Your order has been accepted.");

$mailer = new SendmailMailer();
$mailer->send($message);

$sitesUp = new SitesUp(new Client());
$sitesUp->setRequestSites([
    "http://www.google.com",
    "http://www.google.coms",
    "http://www.cbs.com"
]);


var_dump($sitesUp->checkSites());


function cmp($a, $b)
{
    return ($a['statusCode'] != $b['statusCode']) ? 1 : 0;
}

$t = $sitesUp->checkSites();

usort($t,"cmp");


var_dump($t);

