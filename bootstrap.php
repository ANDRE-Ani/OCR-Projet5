<?php

require_once __DIR__.'/twig/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    "cache" => false
));