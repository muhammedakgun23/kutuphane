<?php
require_once '../vendor/autoload.php';
require '../model/database.php';
session_start();
$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader);
$home = $twig->load('home.twig');
echo $home->render(['session'=>$_SESSION['id']]);
?>