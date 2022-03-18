<?php

session_start();
require 'options.php';


$mybookpages = $twig->load('mybookpages.twig');

$bookid=$_GET['book'];
$sql = "SELECT id, namebook ,authorname,bookimage FROM books WHERE id='$bookid'";
$result = $conn->query($sql);



        $book=[];
    while($row = $result->fetch_assoc()) {
        $book=$row;
       
    
}

print_r($row);
$uyeid = $_SESSION['id'];
echo $mybookpages->render(['book'=>$book]);

?>