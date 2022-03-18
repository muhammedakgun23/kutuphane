<?php
session_start();
require 'options.php';

$home = $twig->load('home.twig');


$sql = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books WHERE booktype='aksiyon' LIMIT 6";
$result = $conn->query($sql);

  

        $bookcategory= [];
    while($row = $result->fetch_assoc()) {
        $bookcategory[]=$row;
       
    
}
$sqli = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books WHERE booktype='macera' LIMIT 6";
$results = $conn->query($sqli);

  

        $bookcategorymacera= [];
    while($rows = $results->fetch_assoc()) {
        $bookcategorymacera[]=$rows;
       
    
}

echo $home->render(['bookcategorymacera'=>$bookcategorymacera,'bookcategory'=>$bookcategory]);

?>