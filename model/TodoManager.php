<?php

// manager for todo tasks

namespace model;

use model\Manager;
use PDO;

class TodoManager extends Manager

{

// write new task in BDD
public function writeTask($todo) {
    $bdd = $this->dbConnect();
    $task = $bdd->prepare('INSERT INTO todolist(todo) VALUES(?)');
    $affectedLines = $task->execute(array($todo));
    return $affectedLines;
}

// read all tasks
public function getTasks() {
    /* $db = $this->dbConnect();
    $req = $db->query('SELECT * FROM todolist ORDER BY datetodo DESC');  
    $req->execute();
    return $req; */
    
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT * FROM todolist ORDER BY datetodo DESC');
    $affectedLines = $req->execute(array());
    return $req;
}


// get a todo
public function getTodo($idTodo) {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, todo, datetodo FROM todolist WHERE id = ?');
    $req->execute(array($idTodo));
    $todoE = $req->fetch();
    return $todoE;
}

// Edit a task
public function editTodoL($todo, $id) {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE todolist SET todo = ? WHERE id = ?');
    $taskE = $req->execute(array($todo, $id));
    return $taskE;
}

// delete a task
public function deleteTodo() {
    $bdd = $this->dbConnect();
    $todoD = $bdd->prepare("DELETE FROM todolist WHERE id=".$_GET['id']);
    $affectedLines = $todoD->execute(array($id));
    return $affectedLines;
}

}