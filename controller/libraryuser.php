<?php
session_start();
require 'options.php';

$libraryuser = $twig->load('libraryuser.twig');


$myid = $_SESSION["id"];

$idaccepid="";
$userid = $_GET['user'];
$sendid = $_SESSION["id"];
$message = "";
$book = "";

/*profilimmi kontrolü*/
if($_GET['user']==$_SESSION['id']){
  $datamessage="benim profil";
}else{
  $datamessage="";
}
/***** */


if (isset($_GET["book"])) {
  $bookid = $_GET['book'];
  $sql = "SELECT id,namebook ,authorname,booktype,bookimage FROM books WHERE id='$bookid'";
  $result = $conn->query($sql);

  while ($row = $result->fetch_assoc()) {
    $book = $row;
  }
}
/*arkadaş sorgu*/
if (isset($_GET["user"])) {
  $idsender = $_GET["user"];
  $sqlfriendaccep = "SELECT friedstatu,senderid,recipientid  FROM addfriends WHERE recipientid=$myid AND senderid=$idsender AND friedstatu=2";
  $resultaccep = $conn->query($sqlfriendaccep);

  if ($resultaccep->num_rows > 0) {

    while ($rowaccep = $resultaccep->fetch_assoc()) {
      $idaccep = $rowaccep["senderid"];
      $idaccepid = $rowaccep["recipientid"];
    }
    $friendacccep = "arkadaaşsınız";
  } else {
    $sqlfriendaccep = "SELECT senderid,friedstatu,recipientid  FROM addfriends WHERE recipientid=$idsender AND senderid=$myid AND friedstatu=2";
    $resultaccep = $conn->query($sqlfriendaccep);

    if ($resultaccep->num_rows > 0) {

      while ($rowaccep = $resultaccep->fetch_assoc()) {
        $idaccep = $rowaccep["senderid"];
        $idaccepid = $rowaccep["recipientid"];
      }
      $friendacccep = "arkadaaşsınız";
    } else {
      $friendacccep = "";
    }
    $sqlfriendaccep = "SELECT senderid,friedstatu,recipientid  FROM addfriends WHERE recipientid=$idsender AND senderid=$myid AND friedstatu=2";
    $resultaccep = $conn->query($sqlfriendaccep);

    if ($resultaccep->num_rows > 0) {

      while ($rowaccep = $resultaccep->fetch_assoc()) {
        $idaccep = $rowaccep["senderid"];
        $idaccepid = $rowaccep["recipientid"];
      }
      $friendacccep = "arkadaaşsınız";
    } else {
      $friendacccep = "";
    }
  }
  /*istekler library sorgusu*/
$sqlfriend = "SELECT id, senderid FROM addfriends WHERE recipientid='$sendid' AND senderid='$idsender' AND friedstatu='1'";
$resultsender = $conn->query($sqlfriend);

if ($resultsender->num_rows > 0) {
    while($rowsender = $resultsender->fetch_assoc()) {
        $idsender=$rowsender;
       $senderidmyadd=$rowsender['senderid'];
        
              
           }
       }else{
         $senderidmyadd="";
       }
     
   }
        
 

  /*kişi kitap sorgu*/
  $sqluser = "SELECT id,name,surname,mail FROM users WHERE id='$userid'";
  $resultuser = $conn->query($sqluser);

  while ($rowuser = $resultuser->fetch_assoc()) {
    $user = $rowuser;
  }
  $sqluserook = "SELECT id,uyeid,namebook ,authorname,booktype,bookimage FROM books WHERE uyeid='$userid'";
  $resultuserook = $conn->query($sqluserook);
  $bookuserook = [];
  while ($rowuserook = $resultuserook->fetch_assoc()) {
    $bookuserook[] = $rowuserook;
  }

/*istek gönderilip gönderilmediği sorgu*/
/*friendsqury*/
$sqlfriend = "SELECT * FROM addfriends WHERE senderid=$sendid AND recipientid=$userid AND friedstatu='1'";
$resultfriend = $conn->query($sqlfriend);
if ($resultfriend->num_rows > 0) {
  $friendadd = array("one" => "gonderilmemis");
} else {
  $friendadd = array("zero" => "gonderilmemis");
}


/**arkadaş ekleme */

if (isset($_POST["friendid"])) {

 
  $status = "1";
  $sendid = $_SESSION["id"];
  $recipiedtid = $_POST["friendid"];

  $sqlfriendtrue = "SELECT  friedstatu FROM addfriends WHERE senderid=$sendid AND recipientid=$recipiedtid";
  $result = $conn->query($sqlfriendtrue);
  if ($result->num_rows > 0) {
    $message = "istek GÖNDERİLMİŞ";
  } else {
    $sqlfried = "INSERT INTO addfriends (recipientid, senderid, friedstatu)
        VALUES ('$recipiedtid', '$sendid', '$status')";

    if ($conn->query($sqlfried) === TRUE) {
      $message = "istek göderildi";
    } else {
      $message = "hata oluştu";
    }
  }
}
/*arkadaş id kontrol*/

if($_SESSION['id']==$idaccepid){
  $friendid = $idaccep;
}else{
  $friendid = $idaccepid;
}



echo $libraryuser->render([
  'library' => $book,
  'user' => $user,
  'userbook' => $bookuserook,
  'message' => $friendadd,
  'accepfriend' => $friendacccep,
  'senderid' => $senderidmyadd,
  'datamessage'=>$datamessage,
  'friendid'=>$friendid 
]);
