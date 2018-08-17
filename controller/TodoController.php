<?php

/**
 * Controler todolist
 */

namespace controller;

use Exception;
use model\TodoManager;

class TodoController extends Controller
{

/**
 * create a new task
 */
    public function creationTodo($todo)
    {
        $TodoManager = new TodoManager();
        $affectedLines = $TodoManager->writeTask($todo);
        if ($affectedLines === false) {
            throw new Exception('Erreur en ajoutant une tâche');
        } else {
            header('Location: index.php?action=infos');
        }
    }

/**
 * list all todo
 */

    public function allTodo()
    {
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
        return $todo;
    }

/**
 * pagination
 */

    public function page()
    {
        $TodoManager = new TodoManager();
        $numberPages = $TodoManager->getNumberPages();
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);

        $paginate = array(
            "nbr" => $numberPages,
            "page" => $page,
        );

        return $paginate;
    }

/**
 * page for edit a task
 */

    public function viewEditTodo($todoId, $twig)
    {
        $TodoManager = new TodoManager();
        $todoList = $TodoManager->getTodo($todoId);

        echo $twig->render('editTodoView.html.twig', array(
            'todoL' => $todo,
            'todoEd' => $todoList,
        ));
    }

/**
 * edit a task
 */

    public function editTodoBack($todo, $id)
    {
        $TodoManager = new TodoManager();
        $affectedLines = $TodoManager->editTodoL($todo, $id);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'éditer la tâche');
        } else {
            header('Location: index.php?action=infos');
        }
    }

/**
 * delete a task
 */

    public function suprTodo($id)
    {
        $TodoManager = new TodoManager();
        $affectedLines = $TodoManager->deleteTodo($id);
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer la tâche');
        } else {
            header('Location: index.php?action=infos');
        }
    }

}
