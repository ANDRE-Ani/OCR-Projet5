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
function allTodo($twig) {
    $TodoManager = new TodoManager();
    $tasks = $TodoManager->getTasks();

    $todo = array();
    while ($data = $tasks->fetch()) {
        $task = array();
        list($date, $time) = explode(" ", $data['datetodo']);
        list($year, $month, $day) = explode("-", $date);
        list($hour, $min, $sec) = explode(":", $time);

      $task['idT'] = nl2br(htmlspecialchars($data['id']));
      $task['todoT'] = htmlspecialchars($data['todo']);
      $task['dateT'] = $data['datetodo'] = "$day/$month/$year" . " - " . "$time";
      
      array_push($todo, $task);
    }

       echo $twig->render('homeView.html.twig', array(
        'todoL' => $todo,
      ));

     // return $data;
    //require('view/homeView.php');
}

// page for editing a task
public function viewEditTodo($todoId, $twig)
{
    $TodoManager = new TodoManager();
    $todoList = $TodoManager->getTodo($todoId);

    echo $twig->render('editTodoView.html.twig', array(
        'todoL' => $todo,
        'todoEd' => $todoList,
      ));
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
public function suprTodo($id)
{
    $TodoManager = new TodoManager();
    $affectedLines = $TodoManager->deleteTodo($id);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer la tache');
    } else {
        header('Location: index.php?action=infos');
    }
}

}
