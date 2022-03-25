<?php
session_start();
require 'options.php';
$sqlnew = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books ORDER BY id DESC limit 6";
$resultnew = $conn->query($sqlnew);


$booknew= [];
while($rownew= $resultnew->fetch_assoc()) {
    $booknew[]=$rownew;
}
$sqlhikaye = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books WHERE booktype='hikaye' LIMIT 6";
$result_hikaye = $conn->query($sqlhikaye);

  

        $bookcategory_hikaye= [];
    while($row_hikaye= $result_hikaye->fetch_assoc()) {
        $bookcategory_hikaye[]=$row_hikaye;
       
    
}
$sqlsiir = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books WHERE booktype='siir' LIMIT 6";
$result_siir = $conn->query($sqlsiir);

  

        $bookcategory_siir= [];
    while($row_siir = $result_siir->fetch_assoc()) {
        $bookcategory_siir[]=$row_siir;
       
    
}

?>