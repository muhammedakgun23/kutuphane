<?php
session_start();
require 'options.php';


session_start();
$header = $twig->load('header.twig');

echo $header->render();


?>