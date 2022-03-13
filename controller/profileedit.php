<?php
session_start();
require 'options.php';
$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader);
$editprofile = $twig->load('profileedit.twig');





echo $editprofile->render();

?>
