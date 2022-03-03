
<?php

require_once '../vendor/autoload.php';
require '../model/database.php';

$loader = new \Twig\Loader\FilesystemLoader('..\view');
$twig = new \Twig\Environment($loader);

$login = $twig->load('login.twig');
$message="";
if (isset($_POST["submit"])) {
    function validate($data){

        $data = trim($data);
 
        $data = stripslashes($data);
 
        $data = htmlspecialchars($data);
 
     }
     
     $name = validate($_POST["name"]);
     $surname = validate($_POST["surname"]);
     $email = validate($_POST["email"]);
     $password = validate($_POST["password"]);

    if (isset($_POST["name"])) {
        $name = $_POST["name"];
        
    } else {
        $name = "";
    }
    if (isset($_POST["surname"])) {
        $surname = $_POST["surname"];
    } else {
        $surname = "";
    }
    if (isset($_POST["email"])) {
        $email = $_POST["email"];
        
    } else {
        $email = "";
    }
    if (isset($_POST["password"])) {
        $password = $_POST["password"];
       
    } else {
        $password = "";
    }

    if(($name!="") and ($surname!="") and ($email!="") and ($password!="")){
    $sqlsearch= "SELECT * FROM users  WHERE mail='$email'";
    $emailsearch = mysqli_query($conn, $sqlsearch);
    if(mysqli_num_rows($emailsearch) > 0){
       $message = "bu mail kullanımdadır";  
      }else{
        
        $sql = "INSERT INTO users (name , surname , mail , password)
        VALUES ('$name','$surname', '$email','$password')";
    
        if ($conn->query($sql) === TRUE) {
           $message= "Kaydınız başarılı şekilde tamamlandı.Giriş yapabilirsiniz";
        } else {
         $message="Lütfen daha sonra tekrar deneyiniz";
        }
      }
    }else{
        $message="Lütfen tüm alanları doldurunuz";

    }

}

echo $login->render(['errorpost'=>$message]);

?>