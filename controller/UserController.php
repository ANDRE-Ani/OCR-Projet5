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
            'cook' => $_SESSION,
            'cook' => $_COOKIE,
            'styleB' => $styleB,
        );
    }


// admin connection
    public function logAdmin($twig)
    {
        if (isset($_POST["login"]) && isset($_POST["pass"])) {
            $UserManager = new UserManager();
            $result = $UserManager->admin($_POST['login'], $_POST['pass']);
            $correctPassword = password_verify($_POST['pass'], $result['pass']);
            $login = ($_POST['login']);
            $_SESSION['cook'] = $login;

            if ($correctPassword != false) {
                session_start();             
                $_SESSION['login'] = $_POST['login'];
                $cookie_name = "cook";
                $cook = $_POST['login'];
                setcookie($cookie_name, $cook, time() + (2*24*3600), "/", "p5ocr.andre-ani.fr", true, true);

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

    // go to admin connection
    public function connectionAdmin($twig)
    {
        echo $twig->render('loginView.html.twig');
    }
    

    // user creation
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
            throw new Exception('Impossible de crÃ©er le compte');
        } else {


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
    

    // list the users
    public function allUsers($twig)
    {
        $UserManager = new UserManager();
        $users = $UserManager->getUsers();
        
        $user = array();
        while ($usersL = $users->fetch()) {
            $userList = array();
            $userList['idU'] = $usersL['id'];
            $userList['loginU'] = $usersL['login'];
            $userList['mailU'] = $usersL['mail'];
            $userList['creationU'] = $usersL['creation'];

            array_push($user, $userList);

        }

        echo $twig->render('allUsersView.html.twig', array(
            'session'   => $_SESSION,
            'usersAll' => $user,

        ));
    }
    

    // delete a user
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
    

    // go to edition user view
    public function viewEditUserB($userId, $twig)
    {
        $UserManager = new UserManager();
        $userE = $UserManager->getUser($userId);

        echo $twig->render('editUserView.html.twig', array(
            'userEd' => $userE,
            'userL' => $user,
            'session'   => $_SESSION,
            'usersAll' => $user,
        ));
    }
    

    // edition user
    public function editUserBack($login, $mail, $id)
    {
        $UserManager = new UserManager();
        $affectedLines = $UserManager->editUserL($login, $mail, $id);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ÃƒÂ©diter l\'utilisateur');
        } else {
            header('Location: index.php?action=administration');
        }
    }
    
    
    // go to creation user
    public function createUserView($twig)
    {
        $UserManager = new UserManager();

        echo $twig->render('loginCreateView.html.twig', array(
            'session' => $_SESSION,
            'cook' => $_COOKIE,
        ));
    }
    

    // go to admin
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
