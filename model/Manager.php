<?php

// manager principal gérant la connexion à la BDD

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
            echo 'Ã‰chec lors de la connexion : ' . $e->getCode() . $e->getMessage();

        }
    }
}
