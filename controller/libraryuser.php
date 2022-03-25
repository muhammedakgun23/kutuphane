<?php
session_start();
require 'options.php';

$libraryuser = $twig->load('libraryuser.twig');
$bookid=$_GET['book'];
$userid=$_GET['user'];


$sql = "SELECT id,namebook ,authorname,booktype,bookimage FROM books WHERE id='$bookid'";
$result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $book=$row;
    
}

$sqluser = "SELECT id,name,surname,mail FROM users WHERE id='$userid'";
$resultuser = $conn->query($sqluser);

    while($rowuser = $resultuser->fetch_assoc()) {
        $user=$rowuser;
     
   
}
$sqluserook = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books WHERE uyeid='$userid'";
$resultuserook = $conn->query($sqluserook);
$bookuserook=[];
    while($rowuserook = $resultuserook->fetch_assoc()) {
        $bookuserook[]=$rowuserook;

}
echo $libraryuser->render(['library'=>$book,'user'=>$user,'userbook'=>$bookuserook]);