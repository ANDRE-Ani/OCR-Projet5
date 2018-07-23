<?php

namespace controller;

use Exception;
use model\TodoManager;
use model\FrontManager;
use model\UserManager;
use model\Manager;

// Controler todolist

class TodoController extends Controller
{

// create a new task
function creationTodo($todo) {
    $TodoManager = new TodoManager();
    $affectedLines = $TodoManager->writeTask($todo);
    if ($affectedLines === false) {
        throw new Exception('Error adding a task');
    }
    else {
        header('Location: index.php?action=infos');
    }
}

// todo list
function allTodo() {
    $TodoManager = new TodoManager();
    $tasks = $TodoManager->getTasks();
    require('view/homeView.php');
}

// page for editing a task
public function viewEditTodo($todoId)
{
    $TodoManager = new TodoManager();
    $todoE = $TodoManager->getTodo($todoId);
    require('view/editTodoView.php');
}

// edit a task
public function editTodoBack($todo, $id)
{
    $TodoManager = new TodoManager();
    $affectedLines = $TodoManager->editTodoL($todo, $id);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'éditer la tache');
    } else {
        header('Location: index.php?action=infos');
    }
}

// delete a task
public function suprTodo()
{
    $TodoManager = new TodoManager();
    $affectedLines = $TodoManager->deleteTodo();
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer la tache');
    } else {
        header('Location: index.php?action=infos');
    }
}

}
