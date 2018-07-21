<?php

// Routeur de l'application

// Redirige toutes les requêtes utilisateur vers les
// bonnes pages et actions

use controller\Controller;
use controller\FileController;
use controller\UserController;
use controller\TodoController;

// Appel des différents controlers
require_once './controller/Controller.php';
require_once './controller/UserController.php';
require_once './controller/FileController.php';
require_once './controller/TodoController.php';

// appel des model
require_once "model/Manager.php";
require_once "model/UserManager.php";
require_once "model/TodoManager.php";

// Routes des actions et requêtes

try {
    // page d'accueil
    if (isset($_GET['action'])) {
        if ($_GET['action'] == '') {
            $infos = new Controller();
            $infos->home();
            $infos->rss();
        }

        // envoie vers la page d'accueil
        elseif ($_GET['action'] == '/') {
            $infos = new Controller();
            $infos->home();
            $infos->rss();
        } 
        
        // upload de fichiers
        elseif ($_GET['action'] == 'upload') {
            $infos = new FileController();
            $infos->uploadF();
        } 
               
        
        // suppression de fichiers
        elseif ($_GET['action'] == 'deleteF') {        
        if (isset($_GET['fichier']) && $_GET['fichier'] > 0) {
            $infos = new FileController();
            $infos->deleteFile();
            }
            else {
            echo 'error fichier';
            }
        } 
        
        // envoie vers la page d'accueil
        elseif ($_GET['action'] == 'homePage') {
            $infos = new Controller();
            $infos->home();
        } 

        // envoie vers la page d'informations
        elseif ($_GET['action'] == 'infos') {
            $infos = new TodoController();
            $infos->allTodo();
            $infos = new Controller();
            $infos->rss();
        } 
        

        // connection à l'admin
        elseif ($_GET['action'] == 'logAdminB') {
            if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {
                $infos = new UserController();
                $infos->logAdmin();
            } else {
                throw new Exception('Tous les champs ne sont pas remplis');
            }
        }
        
        // création de compte
        elseif ($_GET['action'] == 'createUser') {
            if (!empty($_POST['login']) && !empty($_POST['mail']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && ($_POST['pass']) == ($_POST['pass2'])) {
                
            $infos = new UserController();
            $infos->creationUser(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['pass']));
            } 
            else {
                throw new Exception('Tous les champs ne sont pas remplis ou les mots de passe ne correspondent pas');
            }
        }
    

        // ajout tache todolist
        elseif ($_GET['action'] == 'createTodo') {
            if (!empty(htmlspecialchars($_POST['todo']))) {
                $infos = new TodoController();
                $infos->creationTodo($_POST['todo']);
            } else {
                throw new Exception('Erreur, ajoutez une tâche');
            }
         }

         // page for editing a task
        elseif ($_GET['action'] == 'viewEditTask') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new TodoController();
                $infos->viewEditTodo($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de tâche envoyé');
            }
        }

        // editing a task
        elseif ($_GET['action'] == 'editTodo') {
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

        
        // envoie vers la page d'administration
        elseif ($_GET['action'] == 'administration') {
                $infos = new Controller();
                $infos = new UserController();
                $infos->administration();
        }
        
        // envoie vers la page de connection
        elseif ($_GET['action'] == 'connection') {
            $infos = new UserController();
            $infos->connectionAdmin();
        }
        
        
        // deconnection
        elseif ($_GET['action'] == 'logout') {
            $infos = new UserController();
            $infos->connectionAdmin();
            session_start();
            session_unset();
            session_destroy();
            setcookie('admin', '', time());
            header('Location: index.php');
        }
        
        
        // envoie vers la page de création de compte
        elseif ($_GET['action'] == 'creationUser') {
            $infos = new UserController();
            $infos->createUserView();
        }
        
        // envoie vers la page gestion des utilisateurs
        elseif ($_GET['action'] == 'gestionU') {
            $infos = new UserController();
            $infos->allUsers();
        }
        
        // supprimer un utilisateur
        elseif ($_GET['action'] == 'deleteUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new UserController();
                $infos->suprUser();
            } else {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }
        
        // envoie vers la page d'édition d'un utilisateur
        elseif ($_GET['action'] == 'viewEditUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $infos = new UserController();
                $infos->viewEditUserB($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant d\'utilisateur envoyé');
            }
        }
        
        // édition d'un utilisateur
        elseif ($_GET['action'] == 'editUserL') {
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
        $infos->home();
    }

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
