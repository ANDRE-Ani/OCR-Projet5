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
    $task = $bdd->prepare('INSERT INTO todo(todo) VALUES(?)');
    $affectedLines = $task->execute(array($todo));
    return $affectedLines;
}

// read all tasks
public function getTasks() {  
    /* $db = $this->dbConnect();
    $req = $db->prepare('SELECT * FROM todo ORDER BY datetodo DESC');
    $affectedLines = $req->execute(array());
    return $req; */



$db = $this->dbConnect();
$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
$limite = 3;
$debut = ($page - 1) * $limite;
$req = $db->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM todo LIMIT :limite OFFSET :debut');
$req->bindValue('limite', $limite, PDO::PARAM_INT);
$req->bindValue('debut', $debut, PDO::PARAM_INT);
$req->execute();

/* $resultFoundRows = $req->query('SELECT found_rows()');
$nombredElementsTotal = $resultFoundRows->fetchColumn();
$nombreDePages = ceil($nombredElementsTotal / $limite); */


return $req;

/* while ($element = $query->fetch()) {

}

*/




}


// get a todo
public function getTodo($todoId) {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, todo, datetodo FROM todo WHERE id = ?');
    $req->execute(array($todoId));
    $todoE = $req->fetch();
    return $todoE;
}

// Edit a task
public function editTodoL($todo, $id) {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE todo SET todo = ? WHERE id = ?');
    $taskE = $req->execute(array($todo, $id));
    return $taskE;
}

// delete a task
public function deleteTodo($id) {
    $bdd = $this->dbConnect();
    $todoD = $bdd->prepare("DELETE FROM todo WHERE id=".$_GET['id']);
    $affectedLines = $todoD->execute(array($id));
    return $affectedLines;
}

}