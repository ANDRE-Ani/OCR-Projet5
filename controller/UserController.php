<?php

namespace controller;

use Exception;
use model\ComManager;
use model\FrontManager;
use model\UserManager;

// Controler user

class UserController extends Controller
{

// connection à l'admin
    public function logAdmin()
    {
        if (isset($_POST["login"]) && isset($_POST["pass"])) {
            $UserManager = new UserManager();
            $result = $UserManager->admin($_POST['login'], $_POST['pass']);
            $correctPassword = password_verify($_POST['pass'], $result['pass']);
            $login = ($_POST['login']);

            if ($correctPassword != false) {
                session_start();
                $_SESSION['login'] = $_POST['login'];
                $cookie_name = "cook";
                $cook = session_id().microtime().rand(0,9999999999);
                $cook = hash('sha512', $cook);
                setcookie($cookie_name, $cook, time() + 86400, "/", "p5ocr.andre-ani.fr", true, true);
                $_SESSION['cook'] = $cook;
                
                header('Location: index.php?action=infos');
            } else {
                echo 'Login ou mot de passe incorrect';
                echo '<br>';
                echo 'Retour sur la page d\'<a href="https://p5ocr.andre-ani.fr/">accueil</a>';
            }
        } else {
            echo 'Il manque un champ';
        }
    }

    // envoie vers la page de connection pour l'admin
    public function connectionAdmin()
    {
        $FrontManager = new FrontManager();
        $ComManager = new ComManager();
        $UserManager = new UserManager();
        require('view/loginView.php');
    }
    
    // création de compte
    public function creationUser($login, $mail, $pass)
    {
        $UserManager = new UserManager();
        $pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $affectedLines = $UserManager->createUser($login, $mail, $pass_hash);
        if ($affectedLines === false) {
            throw new Exception('Impossible de créer le compte');
        } else {
            header('Location: index.php?action=connection');
        }
    }
    
    // affiche les utilisateurs
    public function allUsers()
    {
        $UserManager = new UserManager();
        $users = $UserManager->getUsers();
        require('view/allUsersView.php');
    }
    
    // supprime un utilisateur
    public function suprUser()
    {
        $UserManager = new UserManager();
        $affectedLines = $UserManager->deleteUser();
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer l\'utilisateur');
        } else {
            header('Location: index.php?action=administration');
        }
    }
    
    // envoie vers la page d'édition d'un utilisateur
    public function viewEditUserB($userId)
    {
        $UserManager = new UserManager();
        $userE = $UserManager->getUser($userId);
        require('view/editUserView.php');
    }
    
    // édition d'un utilisateur
    public function editUserBack($login, $mail, $id)
    {
        $UserManager = new UserManager();
        $affectedLines = $UserManager->editUserL($login, $mail, $id);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'éditer l\'utilisateur');
        } else {
            header('Location: index.php?action=administration');
        }
    }
    
    
    // envoie vers la page de création de compte
    public function createUserView()
    {
        $UserManager = new UserManager();
        require('view/loginCreateView.php');
    }
    
    // envoie vers la page d'administration
    public function administration()
    {
        $UserManager = new UserManager();
        require 'view/administrationView.php';
    }
    
    
    

}
