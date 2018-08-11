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
    //
    // home/login page
    //
    if (isset($_GET['action'])) {
        if ($_GET['action'] == '') {

            session_start();
            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            $infos = new Controller();
            $infos->home($twig);
        }

        //
        // home/login page
        //
        elseif ($_GET['action'] == '/') {

            session_start();
            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            $infos = new Controller();
            $infos->home($twig);
        } 
        

        //
        // home/login page
        //
        elseif ($_GET['action'] == 'homePage') {

            session_start();
            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            $infos = new Controller();
            $infos->home($twig);
        }


        //
        // theme switcher
        //
        elseif ($_GET['action'] == 'styleT') {
            session_start();
            if ((!empty($_SESSION['cook'])) && (!empty($_COOKIE['cook']))) {
            
                if (isset($_POST['style'])) {
                $choix = $_POST['style'];
                setcookie('chose_style', $choix, time() + (2*24*3600), "/", "p5ocr.andre-ani.fr", true, true);

                if ($choix=="blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }

                elseif ($choix=="green") {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }

                else {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
                        
            $infos = new Controller();
            $infos = new UserController();
            $infos->administration($twig);
        }
    }

        //
        // go to legal mentions
        //
        elseif ($_GET['action'] == 'legal') {
            
            session_start();
            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }
            $infos = new Controller();
            $infos->legalM($twig);
        }


        //
        // go to about
        //
        elseif ($_GET['action'] == 'about') {
            
            session_start();
            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }
            
            $infos = new Controller();
            $infos->aboutP($twig);
        } 


        //
        // upload file
        //
        elseif ($_GET['action'] == 'upload') {
            session_start();
            $infos = new FileController();
            $infos->uploadF();
        } 
               
        
        //
        // delete file
        //
        elseif ($_GET['action'] == 'deleteF') {
            session_start();
            $fichier = $_GET['file'];
            $infos = new FileController();
            $infos->deleteFile($fichier);
            }
        

        //    
        // main page/informations
        //
        elseif ($_GET['action'] == 'infos') {
            
            session_start();
            if ((!empty($_SESSION['cook'])) && (!empty($_COOKIE['cook']))) {

            // chose style
            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }


            $infos = new Controller();
            $infos = new UserController();
            $infos = new TodoController();
            $infos = new FileController();
            // $infos->rss($twig);
            // $infos->bitcoin($twig);
            // $infos->allTodo($twig);
            $infos->renderHome($twig);
            // $infos->listFile($twig);

        }
        else {
            header('Location: index.php?action=connection');
        }

    }

        //
        // admin connection
        //
        elseif ($_GET['action'] == 'logAdminB') {
            session_start();

            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
                $infos = new UserController();
                $infos->logAdmin($twig);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis');
            }
        }
        

        //
        // user creation
        //
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
    

        //
        // add todo
        //
        elseif ($_GET['action'] == 'createTodo') {
            session_start();
            if (!empty(htmlspecialchars($_POST['todo']))) {
                $infos = new TodoController();
                $infos->creationTodo(htmlspecialchars($_POST['todo']));
            } else {
                throw new Exception('Erreur, ajoutez une tâche');
            }
         }


        // 
        // page for task edition
        //
        elseif ($_GET['action'] == 'viewEditTask') {
            session_start();

            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new TodoController();
                $infos->viewEditTodo($_GET['id'], $twig);
            } else {
                throw new Exception('Aucun identifiant de tâche envoyé');
            }
        }


        //
        // editing a task
        //
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


        //
        // delete a todo
        //
        elseif ($_GET['action'] == 'deleteTodo') {
            session_start();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new TodoController();
                $infos->suprTodo($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de toto');
            }
        }

        //
        // go to administration
        //
        elseif ($_GET['action'] == 'administration') {
            
            session_start();
            if ((!empty($_SESSION['cook'])) && (!empty($_COOKIE['cook']))) {

            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

                $infos = new Controller();
                $infos = new UserController();
                $infos->administration($twig);

            }
            else {
                header('Location: index.php?action=connection');
            }
        }
        

        //
        // go to connection
        //
        elseif ($_GET['action'] == 'connection') {

            session_start();
            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }
        
            $infos = new UserController();
            $infos->connectionAdmin($twig);
        }
        
        
        //
        // deconnection
        //
        elseif ($_GET['action'] == 'logout') {

            session_start();

            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            $_SESSION = array();
            session_destroy();
            session_unset();

            $infos = new UserController();
            $infos->connectionAdmin($twig);

        }
        
        
        //
        // go to user creation
        //
        elseif ($_GET['action'] == 'creationUser') {
            session_start();

            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            $infos = new UserController();
            $infos->createUserView($twig);
        }
        

        //
        // go to user gestion
        //
        elseif ($_GET['action'] == 'gestionU') {
            session_start();

            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            $infos = new UserController();
            $infos->allUsers($twig);
        }
        
        //
        // delete a user
        //
        elseif ($_GET['action'] == 'deleteUser') {
            session_start();
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new UserController();
                $infos->suprUser();
            } else {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }
        

        //
        // go to user edition
        //
        elseif ($_GET['action'] == 'viewEditUser') {
            session_start();

            if(isset($_COOKIE['chose_style'])) {
                $styleB = $_COOKIE['chose_style'];
                if ($styleB == 'green') {
                    $styleB = "css/style2.css";
                    $twig->addGlobal("styleB", $styleB);
                }
                else if ($styleB == "blue") {
                    $styleB = "css/style.css";
                    $twig->addGlobal("styleB", $styleB);
                }
            }
            else {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
        }

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new UserController();
                $infos->viewEditUserB($_GET['id'], $twig);
            } else {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }
        
        //
        // user edition
        //
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

    //
    // login default
    //
    } else {

        session_start();
        if(isset($_COOKIE['chose_style'])) {
            $styleB = $_COOKIE['chose_style'];
            if ($styleB == 'green') {
                $styleB = "css/style2.css";
                $twig->addGlobal("styleB", $styleB);
            }
            else if ($styleB == "blue") {
                $styleB = "css/style.css";
                $twig->addGlobal("styleB", $styleB);
            }
        }
        else {
            $styleB = "css/style.css";
            $twig->addGlobal("styleB", $styleB);
    }

        $infos = new Controller();
        $infos->home($twig);
    }

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
