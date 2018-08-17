<?php

/**
 * manager for users
 */

namespace model;

use model\Manager;

class UserManager extends Manager
{

/**
 * login control
 */
    public function admin($login)
    {
        $bdd = $this->dbConnect();
        $users = $bdd->prepare('SELECT * FROM users WHERE login = :login');
        $users->bindParam(':login', $login);
        $users->execute();
        $result = $users->fetch();
        $hash = $result[0];
        return $result;
    }

/**
 * user creation
 */
    public function createUser($login, $mail, $pass_hash)
    {
        $bdd = $this->dbConnect();
        $loginU = $bdd->prepare('INSERT INTO users(login, mail, pass) VALUES(?, ?, ?)');
        $affectedLines = $loginU->execute(array($login, $mail, $pass_hash));
        return $affectedLines;
    }

/**
 * get all users
 */
    public function getUsers()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, login, mail, DATE_FORMAT(creation, "%d/%m/%Y à  %Hh%imin") AS creation FROM users ORDER BY creation DESC');
        return $req;
    }

/**
 * get one user
 */
    public function getUser($idUser)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, login, mail FROM users WHERE id = ?');
        $req->execute(array($idUser));
        $userE = $req->fetch();
        return $userE;
    }

/**
 * edit a user
 */
    public function editUserL($login, $mail, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET login = ?, mail = ? WHERE id = ?');
        $userLog = $req->execute(array($login, $mail, $id));
        return $userLog;
    }

/**
 * delete a user
 */
    public function deleteUser()
    {
        $bdd = $this->dbConnect();
        $userD = $bdd->prepare("DELETE FROM users WHERE id=" . $_GET['id']);
        $affectedLines = $userD->execute(array($userId));
        return $affectedLines;
    }

}
