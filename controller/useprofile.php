<?php
session_start();
require 'options.php';


$useprofile = $twig->load('useprofile.twig');

$useid=$_SESSION['id'];

$useprofil="";
$sql = "SELECT name,surname,mail FROM users WHERE id='$useid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $useprofil=$row;
    }
} 


    


echo $useprofile->render(['user'=>$useprofil]);
?>