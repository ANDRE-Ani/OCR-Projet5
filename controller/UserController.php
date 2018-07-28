<?php

namespace controller;

use Exception;
use model\UserManager;
use model\TodoManager;


// Controler user

class UserController extends Controller
{


    public function getGlobals() {
        return array(
            'session' => $_SESSION,
            'cook' => $_COOKIE,
        ) ;
    }


// admin connection
    public function logAdmin($twig)
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
                
                // header('Location: index.php?action=infos');
                echo $twig->render('homeView.html.twig', array(
                    'session' => $_SESSION,
                    'cook' => $_COOKIE,
                ));

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
    public function connectionAdmin($twig)
    {
        echo $twig->render('loginView.html.twig');
    }
    
    // création de compte
    public function creationUser($twig, $login, $mail, $pass)
    {
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $login = $_POST['login'];

        // lenght pass verification
        if (strlen($pass) < 8) {
            throw new Exception('Mot de passe trop court');
          }
          // mail verification
          $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
          if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Mail invalide');
          }
          // login with only letters
          if (!preg_match("/^[a-zA-Z ]*$/",$login)) {
            throw new Exception('Identifiant invalide');
            }
        $UserManager = new UserManager();
        $pass_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $affectedLines = $UserManager->createUser($login, $mail, $pass_hash);
        if ($affectedLines === false) {
            throw new Exception('Impossible de créer le compte');
        } else {
            // header('Location: index.php?action=administration');

        session_start();
        $_SESSION['login'];

        echo $twig->render('administrationView.html.twig', array(
            'sys' => $system,
            'host' => $host,
            'arch' => $arch,
            'php' => $phpversion,
            'mail' => $mailAdmin,
            'servAdd' => $servAdd,
            'servHost' => $servHost,
            'visitorLang' => $visitorLang,
            'session'   => $_SESSION,

        ));






        }
    }
    

    // affiche les utilisateurs
    public function allUsers($twig)
    {
        $UserManager = new UserManager();
        $users = $UserManager->getUsers();
        
        session_start();
        $_SESSION['login'];

        echo $twig->render('allUsersView.html.twig', array(
            'session'   => $_SESSION,

        ));
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
    public function createUserView($twig)
    {
        $UserManager = new UserManager();
        // echo $twig->render('loginCreateView.html.twig');

        session_start();
        $_SESSION['login'];

        echo $twig->render('loginCreateView.html.twig', array(
            'session' => $_SESSION,
            'cook' => $_COOKIE,
        ));
    }
    
    // envoie vers la page d'administration
    public function administration($twig)
    {                
        $UserManager = new UserManager();

        $system = php_uname(s);
        $host = php_uname(n);
        $arch = php_uname(m);
        $phpversion  = phpversion();
        $mailAdmin = $_SERVER['SERVER_ADMIN'];
        $servAdd = $_SERVER['SERVER_ADDR'];
        $servHost = $_SERVER['HTTP_HOST'];
        $visitorLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

        session_start();
        $_SESSION['login'];

        echo $twig->render('administrationView.html.twig', array(
            'sys' => $system,
            'host' => $host,
            'arch' => $arch,
            'php' => $phpversion,
            'mail' => $mailAdmin,
            'servAdd' => $servAdd,
            'servHost' => $servHost,
            'visitorLang' => $visitorLang,
            'session'   => $_SESSION,

        ));

    }
  

}
