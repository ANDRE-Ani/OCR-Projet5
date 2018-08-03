<?php

// Twig init
require_once __DIR__ . '/vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    'globals' => array(
        'session' => 'mon_user'),

));
$twig->addExtension(new Twig_Extension_Debug());
$twig->addExtension(new Twig_Extensions_Extension_I18n());
$twig->addGlobal("session", $_SESSION);
$twig->addGlobal("site_name", '5Project');
$twig->addGlobal("site_author", 'Patrice Andreani');


// autoloader
require_once("autoloader.php");


// Use of needed controller
use controller\Controller;
use controller\FileController;
use controller\UserController;
use controller\TodoController;


// call to models
require_once "model/Manager.php";
require_once "model/UserManager.php";
require_once "model/TodoManager.php";


// routing for actions

try {
    // home/login page
    if (isset($_GET['action'])) {
        if ($_GET['action'] == '') {
            $infos = new Controller();
            $infos->home($twig);
        }

        // home/login page
        elseif ($_GET['action'] == '/') {
            $infos = new Controller();
            $infos->home($twig);
        } 
        
        // home/login page
        elseif ($_GET['action'] == 'homePage') {
            $infos = new Controller();
            $infos->home($twig);
        }


        // go to legal mentions
        elseif ($_GET['action'] == 'legal') {
            session_start();
            $infos = new Controller();
            $infos->legalM($twig);
        }


        // go to about
        elseif ($_GET['action'] == 'about') {
            session_start();
            $infos = new Controller();
            $infos->aboutP($twig);
        } 


        // upload file
        elseif ($_GET['action'] == 'upload') {
            session_start();
            $infos = new FileController();
            $infos->uploadF();
        } 
               
        
        // delete file
        elseif ($_GET['action'] == 'deleteF') {
            session_start();
            $fichier = $_GET['file'];
            $infos = new FileController();
            $infos->deleteFile($fichier);
            }
        

        // main page/informations
        elseif ($_GET['action'] == 'infos') {
            session_start();
            /* session_start();
            if ($_COOKIE['cook'] == $_SESSION['cook']) {
            $cook = session_id().microtime().rand(0,9999999999);
            $cook = hash('sha512', $cook);
            $_COOKIE['cook'] = $cook;
            $_SESSION['cook'] = $cook; */

            $infos = new Controller();
            $infos = new UserController();
            $infos = new TodoController();
            // $infos = new FileController();
            //$infos->rss($twig);
            // $infos->bitcoin($twig);
            $infos->allTodo($twig);
            // $infos->listFile($twig);

        /* }
        else {
            $_SESSION = array();
            session_destroy();
            header('Location: index.php?action=connection');
        } */

    }






        // admin connection
        elseif ($_GET['action'] == 'logAdminB') {
            session_start();
            if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
                $infos = new UserController();
                $infos->logAdmin($twig);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis');
            }
        }
        
        // user creation
        elseif ($_GET['action'] == 'createUser') {
            session_start();
            if (!empty($_POST['login']) && !empty($_POST['mail']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && ($_POST['pass']) == ($_POST['pass2'])) {
            $infos = new UserController();
            $infos->creationUser($twig, htmlspecialchars($_POST['login']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['pass']));
                    
        } 
            else {
                throw new Exception('Tous les champs ne sont pas remplis ou les mots de passe ne correspondent pas');
            }
        }
    

        // add todo
        elseif ($_GET['action'] == 'createTodo') {
            session_start();
            if (!empty(htmlspecialchars($_POST['todo']))) {
                $infos = new TodoController();
                $infos->creationTodo(htmlspecialchars($_POST['todo']));
            } else {
                throw new Exception('Erreur, ajoutez une tâche');
            }
         }

         // page for task edition
        elseif ($_GET['action'] == 'viewEditTask') {
            session_start();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new TodoController();
                $infos->viewEditTodo($_GET['id'], $twig);
            } else {
                throw new Exception('Aucun identifiant de tâche envoyé');
            }
        }

        // editing a task
        elseif ($_GET['action'] == 'editTodo') {
            session_start();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty(htmlspecialchars($_POST['todo']))) {
                    $infos = new TodoController();
                    $infos->editTodoBack($_POST['todo'], $_GET['id']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis pour l\'édition');
                }
            } else {
                throw new Exception('Aucun identifiant de tache envoyé');
            }
        }

        // delete a todo
        elseif ($_GET['action'] == 'deleteTodo') {
            session_start();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new TodoController();
                $infos->suprTodo($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de toto');
            }
        }

        
        // envoie vers la page d'administration
        elseif ($_GET['action'] == 'administration') {
            session_start();
            /* session_start();
            if ($_COOKIE['cook'] == $_SESSION['cook']) {

            $cook = session_id().microtime().rand(0,9999999999);
            $cook = hash('sha512', $cook);
            $_COOKIE['cook'] = $cook;
            $_SESSION['cook'] = $cook; */

                $infos = new Controller();
                $infos = new UserController();
                $infos->administration($twig);

            /* }
            else {
                $_SESSION = array();
                session_destroy();
                header('Location: index.php?action=connection');
            } */
        }
        
        // envoie vers la page de connection
        elseif ($_GET['action'] == 'connection') {
            $infos = new UserController();
            $infos->connectionAdmin($twig);
        }
        
        
        // deconnection
        elseif ($_GET['action'] == 'logout') {
            $infos = new UserController();
            $infos->connectionAdmin($twig);
            session_start();
            session_unset();
            session_destroy();
            setcookie('cook', '', time()-42000);
        }
        
        
        // envoie vers la page de création de compte
        elseif ($_GET['action'] == 'creationUser') {
            session_start();
            $infos = new UserController();
            $infos->createUserView($twig);
        }
        
        // envoie vers la page gestion des utilisateurs
        elseif ($_GET['action'] == 'gestionU') {
            session_start();
            $infos = new UserController();
            $infos->allUsers($twig);
        }
        
        // supprimer un utilisateur
        elseif ($_GET['action'] == 'deleteUser') {
            session_start();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new UserController();
                $infos->suprUser();
            } else {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }
        
        // envoie vers la page d'édition d'un utilisateur
        elseif ($_GET['action'] == 'viewEditUser') {
            session_start();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new UserController();
                $infos->viewEditUserB($_GET['id'], $twig);
            } else {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }
        
        // édition d'un utilisateur
        elseif ($_GET['action'] == 'editUserL') {
            session_start();

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_GET['id']) && !empty($_POST['login'] && !empty($_POST['mail']))) {
                    $infos = new UserController();
                    $infos->editUserBack($_POST['login'], $_POST['mail'], $_GET['id']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis pour l\'édition');
                }
            } else {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }


    // page d'accueil
    } else {
        $infos = new Controller();
        $infos->home($twig);
    }

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
