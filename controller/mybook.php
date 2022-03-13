<?php

session_start();
require 'options.php';

$loader = new \Twig\Loader\FilesystemLoader('../view');
$twig = new \Twig\Environment($loader);
$mybook = $twig->load('mybook.twig');

$uyeid = $_SESSION['id'];
$file_path = '../view/images/books/';
$message = "";
if (isset($_POST["submit"])) {
    function filter($data)
    {
        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);
    }

    $imgbook = filter($_FILES["imgbook"]['name']);
    $imgbooktype = filter($_FILES["imgbook"]["tmp_name"]);
    $namebook = filter($_POST["namebook"]);
    $authorname = filter($_POST["authorname"]);
    $booktopic = filter($_POST["topic"]);

    if ($_FILES['imgbook']['name']!="") {
        $filetype = $_FILES['imgbook']['type'];
        if (($filetype == "image/png") or ($filetype == "image/jpg")) {
            
        
            $file = time()."-". basename($_FILES['imgbook']['name']);
           
        
        if (isset($_POST['namebook'])) {
            $namebook = $_POST['namebook'];
        } else {
            $namebook = "";
        }
        if (isset($_POST['authorname'])) {
            $authorname = $_POST['authorname'];
        } else {
            $authorname = "";
        }
        if (isset($_POST['topic'])) {
            $topic = $_POST['topic'];
        } else {
            $topic = "";
        }

        if (($namebook != "") and ($authorname != "") and ($topic != "") and ($file != "")) {
            $sql = "INSERT INTO books (uyeid, namebook, authorname, booktype,bookimage)
        VALUES ('$uyeid','$namebook','$authorname', '$topic','$file')";

            if ($conn->query($sql) === TRUE) {
                $message = "Kitabınız başarılı şekilde yüklendi";
                $file_path = $file_path. time()."-". basename($_FILES['imgbook']['name']);
                move_uploaded_file($_FILES['imgbook']['tmp_name'], $file_path);
            } else {
                $message = "Lütfen daha sonra tekrar deneyiniz";
            }
        } else {
            $message = "lütfen tüm alanları doldurunuz";
        }
    } else {
        $message = "lütfen png veya jpg uzantılı resim seçiniz";
    }
}else {
        $message = "lütfen tüm alanları doldurunuz";
    }
}
$sql = "SELECT id ,namebook ,authorname,bookimage FROM books WHERE uyeid='$uyeid'";
$result = $conn->query($sql);
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $books[]=$row;
       
    }

echo $mybook->render(['message'=>$message,'book'=>$books]);
?>
