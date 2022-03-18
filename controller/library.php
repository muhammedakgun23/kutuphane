<?php
session_start();
require 'options.php';

$library = $twig->load('library.twig');

$sql = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books";
$result = $conn->query($sql);

  

        $book= [];
    while($row = $result->fetch_assoc()) {
        $book[]=$row;
       
   
}
echo $library->render(['library'=>$book]);