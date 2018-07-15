<?php

namespace controller;

use model\ComManager;
use model\FrontManager;
use model\UserManager;

// Controler principal

class Controller
{

// page d'accueil/accueil
    public function home()
    {
        require 'view/loginView.php';
    }
    
    // envoie vers la page d'informations
    public function infosB()
    {
        $UserManager = new UserManager();
        require 'view/homeView.php';
    }

    // page d'erreur
    public function error404()
    {
        require '../view/errorView.php';
    }


}
