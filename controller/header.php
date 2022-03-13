<?php
session_start();
require 'options.php';

$loader = new \Twig\Loader\FilesystemLoader('../template');
$twig = new \Twig\Environment($loader);
session_start();
$header = $twig->load('header.twig');

echo $header->render();


?>