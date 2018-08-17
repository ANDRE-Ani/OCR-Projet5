<?php

/**
 * main controller, with namespace
 */

namespace controller;

require_once 'config.php';

class Controller
{

    public function getGlobals()
    {
        return array(
            'session' => $_SESSION,
            'cook' => $_SESSION,
            'cook' => $_COOKIE,
            'styleB' => $styleB,
        );
    }

    /**
     * get var for display infos page
     */
    public function renderHome($twig)
    {

        $rssT = $this->rss($feed);
        $bitcoinT = $this->bitcoin($crypto);
        $listFileT = $this->listFile($filesAll);
        $allTodoT = TodoController::allTodo($todo);
        $pageT = TodoController::page($paginate);

        echo $twig->render('homeView.html.twig', array(
            'rss' => $rssT,
            'bitcoin' => $bitcoinT,
            'allTodo' => $allTodoT,
            'nbrPages' => $pageT['nbr'],
            'page' => $pageT['page'],
            'listFile' => $listFileT,
        ));
    }

    /**
     * home/connection
     */
    public function home($twig)
    {
        echo $twig->render('loginView.html.twig');
    }

    /**
     * legales
     */
    public function legalM($twig)
    {
        echo $twig->render('legalView.html.twig', array(
            'session' => $_SESSION,
            'cook' => $_SESSION,
            'cook' => $_COOKIE,
        ));
    }

    /**
     * about
     */
    public function aboutP($twig)
    {
        echo $twig->render('aboutView.html.twig', array(
            'session' => $_SESSION,
            'cook' => $_SESSION,
            'cook' => $_COOKIE,
        ));
    }

    /**
     * send mail
     */
    public function sendM($sujet, $destinataire, $message)
    {
        $expediteur = 'contact@andre-ani.fr';
        $headers = 'MIME-Version: 1.0' . "\n";
        $headers .= "Content-type: text/plain; charset=utf-8\n";
        $headers .= 'Reply-To: ' . $expediteur . "\n";
        $headers .= 'From: "Patrice Andreani"<' . $expediteur . '>' . "\n";
        $headers .= "Cc : contact@andre-ani.fr\n";
        $headers .= 'Delivered-to: ' . $destinataire . "\n";
        $headers .= "X-Priority : 3\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n";

        if (mail($destinataire, $sujet, $message, $headers)) {
            header('Location: index.php?action=infos');
        } else {
            throw new Exception('Le message n\a pas Ã©tÃ© envoyÃ©...');
            header('Location: index.php?action=infos');
        }
    }

    /**
     * RSS function
     */
    public function rss()
    {
        $flux = FLUX_RSS;
        $feedIo = \FeedIo\Factory::create()->getFeedIo();
        $result = $feedIo->readSince($flux, new \DateTime('-1 days'));
        $result = $feedIo->read($flux);
        $feed = $result->getFeed();
        return $feed;

    }

    /**
     * get bitcoin informations
     */
    public function bitcoin()
    {
        $api_url = 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC&tsyms=EUR,USD';
        $cryptocurrency = json_decode(file_get_contents($api_url));
        $crypto = array();
        foreach ($cryptocurrency as $key => $value) {
            $value = array();
            $value['priceUSD'] = (float) $cryptocurrency->$key->EUR;
            $value['priceEUR'] = (float) $cryptocurrency->$key->USD;
            array_push($crypto, $value);
        }
        return $crypto;
    }

}
