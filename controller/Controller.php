<?php

namespace controller;

use model\FrontManager;
use model\UserManager;
use model\TodoManager;
use model\Manager;

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
        $i = 0;

        $feed = array();

        foreach ($rss_feed->channel->item as $feed_item) {
            $item = array();
            $item['datetime'] = date_create($item->pubDate);
            $item['date'] = date_format($item['datetime'], 'd M Y, H\hi');
            $item['title'] = $feed_item->title;
            $item['link'] = $feed_item->link;
            $item['description'] = $feed_item->description;

            if ($i >= 5) {
                break;
            }

            array_push($feed, $item);

            

        }
        
    }
    return $feed;
}

}
    