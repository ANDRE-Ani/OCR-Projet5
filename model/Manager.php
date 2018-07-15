<?php

// manager principal g�rant la connexion � la BDD

namespace model;

include 'config.php';

class Manager
{
    protected function dbConnect()
    {
        try {
            $bdd = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            return $bdd;
        } catch (PDOException $e) {
            echo 'Échec lors de la connexion : ' . $e->getCode() . $e->getMessage();

        }
    }
}
