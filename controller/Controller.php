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
        require 'view/loginView.php';
    }
    
    // envoie vers la page d'informations
    /* public function infosB()
    {
        $UserManager = new UserManager();
        $TodoManager = new TodoManager();
        $Manager = new TodoManager();
        require 'view/homeView.php';
    } */

    // page d'erreur
    public function error404()
    {
        require '../view/errorView.php';
    }


}
