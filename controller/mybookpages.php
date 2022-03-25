<?php

session_start();
require 'options.php';


$mybookpages = $twig->load('mybookpages.twig');
$uyeid = $_SESSION['id'];
$bookid=$_GET['book'];
$message="";
$sql = "SELECT id, namebook ,authorname,booktype,bookimage FROM books WHERE id='$bookid'";
$result = $conn->query($sql);
        $book=[];
    while($row = $result->fetch_assoc()) {
        $book=$row;
}

if(isset($_POST['submit'])){
    function filter($data){

        $data = trim($data);
 
        $data = stripslashes($data);
 
        $data = htmlspecialchars($data);
 
        return $data;
 
     }
     $book_id = filter($_POST["submit"]);
     $img = filter($_POST["imgbook"]);
     $namebook =filter($_POST["namebook"]);
     $authorname =filter($_POST["authorname"]);
     $topic =filter($_POST["topic"]);

if(($img!="") and ($namebook!="")and ($authorname!="")and ($topic!="")){

    $sqli = "UPDATE books SET namebook='$namebook',authorname='$authorname',booktype='$topic', bookimage='$img' WHERE id=$book_id";

    if ($conn->query($sqli) === TRUE) {
        $message="başarılı şekilde güncellenmiştir";
      } else {
        $message="hata daha sonra tekrar deneyiniz: " . $conn->error;
      }
      
      $conn->close();
    }
}
if(isset($_GET['bookimg'])){
  $id= $_GET['book'];
  $img=$_GET['bookimg'];

  $file_path = '../view/images/books/'.$img;

  $sql = "DELETE FROM books WHERE id='".$id."'";
  
    if ($conn->query($sql)) {
          
      unlink($file_path);
      $message="başarılı şekilde silindi";
     header("Location:mybook.php");
         
      } else {
         
      }


}




echo $mybookpages->render(['book'=>$book,'message'=>$message]);

?>