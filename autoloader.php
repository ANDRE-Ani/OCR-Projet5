<?php

namespace controller;

spl_autoload_register(function($class) {
    $filecl = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if(file_exists($filecl)) {
      require_once $filecl;
    } else {
        throw new Exception('Erreur de chargement de la classe ' . $filecl);
      return;
    }
});
