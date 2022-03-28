<?php
session_start();
require 'options.php';


$useprofile = $twig->load('friendpages.twig');

$useid=$_SESSION['id'];
$friendstatu=1;
$idsenderinfor=[];
$idaccepuser=[];

/*arkadaş sil ve onay*/
if(isset($_POST["friendid"])){

  $status="1";
  $sendid=$_SESSION["id"];
  $recipiedtid=$_POST["friendid"];
  
  $sqlfriendtrue="SELECT  friedstatu FROM addfriends WHERE senderid=$sendid AND recipientid=$recipiedtid";
  $result = $conn->query($sqlfriendtrue);
  if ($result->num_rows > 0) {
      $message="istek GÖNDERİLMİŞ";
    } else {
      $sqlfried = "INSERT INTO addfriends (recipientid, senderid, friedstatu)
      VALUES ('$recipiedtid', '$sendid', '$status')";
      
      if ($conn->query($sqlfried) === TRUE) {
       $message="istek göderildi";
      } else {
          $message="hata oluştu";
      
      }
    }

  }
if(isset($_GET["accep"]) and isset($_GET["friend"])){
  $accep=$_GET["accep"];
  $sendid=$_GET["friend"];

  $sql = "UPDATE addfriends SET friedstatu='$accep' WHERE recipientid=$useid AND  senderid=$sendid" ;

  if ($conn->query($sql) === TRUE) {
      $message="Onaylandı";
      
    } else {
      $message="hata!! daha sonra tekrar deneyiniz: " . $conn->error;
    }
    
    
  }
  if(!isset($_GET["accep"]) and isset($_GET["friend"])){
    $sendid=$_GET["friend"];
  
    $sql = "DELETE FROM addfriends WHERE  recipientid=$useid AND  senderid=$sendid";

    if ($conn->query($sql)) {
       
          echo  "kullanıcı sil kbaşarılı";
         
      } else {
         echo "kullanıcı sil kbalşarısız";
      }
  
    if ($conn->query($sql) === TRUE) {
        $message="Onaylandı";
        
      } else {
        $message="hata!! daha sonra tekrar deneyiniz: " . $conn->error;
      }
      
      
    }



/*arkadaşlık istekleri*/
$sqlfriend = "SELECT id, senderid FROM addfriends WHERE recipientid='$useid' AND friedstatu='$friendstatu'";
$resultsender = $conn->query($sqlfriend);

if ($resultsender->num_rows > 0) {

    while($rowsender = $resultsender->fetch_assoc()) {
        $idsender[]=$rowsender;
       $senderid=$rowsender['senderid'];

       $sqlfriendinfor = "SELECT id, name,surname,mail FROM users WHERE id='$senderid'";
       $resultinfor = $conn->query($sqlfriendinfor);
       if ($resultinfor->num_rows > 0) {
           
           while($rowinfor = $resultinfor->fetch_assoc()) {
               $idsenderinfor[]=$rowinfor;
              
           }
       } 
     
   }
        
 }
    /*arkadaşlar*/
 $sqlfriendaccep = "SELECT senderid FROM addfriends WHERE recipientid=$useid AND friedstatu=2";
 $resultaccep = $conn->query($sqlfriendaccep);
 
 if ($resultaccep->num_rows > 0) {
 
     while($rowaccep = $resultaccep->fetch_assoc()) {
         $idaccep=$rowaccep["senderid"];
       
 
 
 
        $sqlfrienaccepuser = "SELECT id, name,surname,mail FROM users WHERE id='$idaccep'";
        $resultinfor = $conn->query($sqlfrienaccepuser);
        if ($resultinfor->num_rows > 0) {
            
            while($rowinfor = $resultinfor->fetch_assoc()) {
                $idaccepuser[]=$rowinfor;
               
            }
        } 
        else {
        
        }
      
    }
         
  }

echo $useprofile->render(['friend'=>$idsenderinfor,'myfriend'=>$idaccepuser]);