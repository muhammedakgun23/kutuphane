<?php

require_once '../vendor/autoload.php';
require '../model/database.php';
require 'sessionopt.php';
$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader);

?>