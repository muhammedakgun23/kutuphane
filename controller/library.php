<?php
session_start();
require 'options.php';

$library = $twig->load('library.twig');


if(isset($_POST['query'])){

    $name=$_POST['query'];
    $search = "SELECT * FROM books WHERE namebook LIKE '%$name%'";
    $results = $conn->query($search);
   
       $book=[];
   while($rows = $results->fetch_assoc()) {
        $book[]=$rows;
        
}


echo $library->render(['library'=>$book]);


}else{
    $sql = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books";
    $result = $conn->query($sql);
    
           $book=[];
        while($row = $result->fetch_assoc()) {
            $book[]=$row;
           
       
    }
   


    
}
echo $library->render(['library'=>$book]);


