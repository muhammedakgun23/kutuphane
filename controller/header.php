<?php
session_start();
require 'options.php';



$header = $twig->load('header.twig');

echo $header->render();


?>