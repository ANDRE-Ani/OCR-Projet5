<?php

namespace controller;

use model\FrontManager;
use model\UserManager;
use model\TodoManager;
use model\Manager;


// Twig init
require_once('bootstrap.php');

// Controler principal

class Controller
{

// page d'accueil/accueil
    public function home()
    {
        // require 'view/loginView.php';
    }
    
    // mentions legales
    public function legalM()
    {
        // require 'view/legalView.php';
    }

    // about
    public function aboutP()
    {
        // require 'view/aboutView.php';
    }

    // page d'erreur
    public function error404()
    {
        require '../view/errorView.php';
    }


// function RSS
function rss()
{
$rss_feed = simplexml_load_file(FLUX_RSS);
    if (!empty($rss_feed)) {
        $feed = array();
        foreach ($rss_feed->channel->item as $feed_item) {
            $item = array();
            $item['datetime'] = date_create($item->pubDate);
            $item['date'] = date_format($item['datetime'], 'd M Y, H\hi');
            $item['title'] = $feed_item->title;
            $item['link'] = $feed_item->link;
            $item['description'] = $feed_item->description;

            if (strlen($item['description']) > 150) {
                $stringCut = substr($item['description'], 0, 150);
                $item['description'] = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
            }
            array_push($feed, $item);
        }
    }
    return $feed;
    //echo $twig->render('homeView.html.twig', array(
      //  'rss' => $feed,
    //));
}


// get bitcoin informations
function bitcoin() {
    $api_url='https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC&tsyms=EUR,USD';
    $cryptocurrency = json_decode(file_get_contents($api_url));
    
    $crypto = array();

    foreach($cryptocurrency as $key => $value)
    {
        $value = array();
        $value['priceUSD'] = (float) $cryptocurrency->$key->EUR;
        $value['priceEUR'] = (float) $cryptocurrency->$key->USD;
    
        array_push($crypto, $value);
    }
    return $crypto;
} 

}
    