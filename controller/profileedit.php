<?php
session_start();
require 'options.php';

$editprofile = $twig->load('profileedit.twig');





echo $editprofile->render();

?>
