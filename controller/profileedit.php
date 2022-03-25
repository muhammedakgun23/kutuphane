<?php
session_start();
require 'options.php';

$editprofile = $twig->load('profileedit.twig');

$useid=$_SESSION['id'];
$message="";



$sqli = "SELECT id, name,surname,mail FROM users WHERE id='$useid'";
$results = $conn->query($sqli);

if ($results->num_rows > 0) {

    while($row = $results->fetch_assoc()) {
        $useprofil=$row;
    }
} 

/*delete user  */
if(isset($_POST['delete_user'])){
    
    $id_user=$_POST["delete_user"];

    

   
    $sqlimg = "SELECT bookimage FROM books WHERE uyeid='$id_user'";
    $resultimg = $conn->query($sqlimg);
    
    
            $books="";
        while($rowimg = $resultimg->fetch_assoc()) {
             foreach($rowimg as $img ){
             
               $file_path = '../view/images/books/'.$img;
                unlink($file_path);
             }      
        
    }
    
  $sql = "DELETE FROM books WHERE uyeid='".$id_user."'";

	if ($conn->query($sql)) {
     
        echo  "kullanıcı sil kbaşarılı";
       
    } else {
       echo "kullanıcı sil kbalşarısız";
    }

$sqldeleteuser = "DELETE FROM users WHERE id=$id_user";

if ($conn->query($sqldeleteuser) === TRUE) {
 session_destroy();
  if(!isset($_SESSION['id'])){
    
    header("Location:login.php");
}
} else {
  echo "Error deleting record: " . $conn->error;
}


}


/* update user*/

if(isset($_POST['update'])){
    function filter($data){

        $data = trim($data);
 
        $data = stripslashes($data);
 
        $data = htmlspecialchars($data);
 
        return $data;
 
     }
     $name = filter($_POST["name"]);
     $surname =filter($_POST["surname"]);
     $email =filter($_POST["email"]);

if(($name!="") and ($surname!="")and ($email!="")){

    $sql = "UPDATE users SET name='$name',surname='$surname',mail='$email' WHERE id=$useid";

    if ($conn->query($sql) === TRUE) {
        $message="başarılı şekilde güncellenmiştir";
        header("Refresh:2; useprofile.php");
      } else {
        $message="hata daha sonra tekrar deneyiniz: " . $conn->error;
      }
      
      $conn->close();
    }
}

echo $editprofile->render(['user'=>$useprofil,'message'=>$message]);

?>
