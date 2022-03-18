<?php

session_start();
require 'options.php';


$mybookpages = $twig->load('mybookpages.twig');

$id= $_POST['id'];
$img= $_POST['img'];
$file_path = '../view/images/books/'.$img;
$sql = "DELETE FROM books WHERE id='".$id."'";

	if ($conn->query($sql)) {
        unlink($file_path);
       
    } else {
       
    }

	$mysqli->close();
