<?php

namespace controller;

use model\FrontManager;
use model\UserManager;
use model\TodoManager;
use model\Manager;

require_once 'config.php';

// Controler principal

class Controller
{

    public function getGlobals() {
        return array(
            'session' => $_SESSION,
            'cook' => $_SESSION,
            'cook' => $_COOKIE,
            'styleB' => $styleB,
        );
    }




// get var for display infos page
public function renderHome($twig) {

    $rssT = $this->rss($feed);
    $bitcoinT = $this->bitcoin($crypto);
    $listFileT = $this->listFile($filesAll);
    $allTodoT = TodoController::allTodo($todo);
    
    echo $twig->render('homeView.html.twig', array(
    'rss' => $rssT,
    'bitcoin' => $bitcoinT,
    'allTodo' => $allTodoT,
    'nbrPages' => $nbrPages,
    'page' => $page,
    'listFile' => $listFileT,
    ));
}


// home/connection
    public function home($twig)
    {
        echo $twig->render('loginView.html.twig');
    }
    
    // legales
    public function legalM($twig)
    {
        echo $twig->render('legalView.html.twig', array(
            'session' => $_SESSION,
            'cook' => $_SESSION,
            'cook' => $_COOKIE,
        ));
    }

    // about
    public function aboutP($twig)
    {
        echo $twig->render('aboutView.html.twig', array(
            'session' => $_SESSION,
            'cook' => $_SESSION,
            'cook' => $_COOKIE,
        ));
    }

    // error
    public function error404()
    {
        require '../view/errorView.php';
    }


// RSS function
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
    