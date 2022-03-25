<?php
include "../model/home.php";

$home = $twig->load('home.twig');




echo $home->render(['siir'=>$bookcategory_siir,'hikaye'=>$bookcategory_hikaye,'roman'=> $booknew]);

?>