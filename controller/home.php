<?php
session_start();
require 'options.php';
$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader);
$home = $twig->load('home.twig');





echo $home->render(array(['session'=>$_SESSION['id']]));

?>