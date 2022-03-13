<?php
session_start();

require_once '../vendor/autoload.php';
require '../model/database.php';


$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader);
$login = $twig->load('login.twig');


$loginmessage="";
if (isset($_POST["submit"])) {
   /*filter function*/
    function filter($data){

        $data = trim($data);
 
        $data = stripslashes($data);
 
        $data = htmlspecialchars($data);
 
        return $data;
 
     }
     $email = filter($_POST["email"]);
     $password =filter($_POST["password"]);
     
/*post variables control*/
    if(($email!="") and ($password!="")){
      $password=hash("sha256",$password);
 
  /*login sql control*/
    $sql = "SELECT id FROM users WHERE mail = '$email' and password = '$password'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    
   
      
    if($count == 1) { 
      $userid=$row[0];
      $_SESSION['id']=$userid;
      header("Location:home.php");  
    }else {
      $loginmessage = "lütfen bilgilerinizi kontrol ediniz";
    }
}else{
    $loginmessage="lütfen tüm alanları doldurunuz";
 }
}

echo $login->render(['loginmessage'=>$loginmessage]);
