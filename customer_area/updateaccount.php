<?php

session_start();
include("./db_connect.php");

$email1 = $_SESSION['email'];

if(isset($_POST['save'])){

  $user = $_POST['username'];
  $email = $_POST['email'];

  $newFileName = '';

    $file = $_FILES["profile_picture"];
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];

    if ($fileError === 0) {
        $accepted_type = array('jpg', 'jpeg', 'gif', 'png', 'jfif');
        $getExtension = explode('.', $fileName);
        $extension = strtolower(end($getExtension));

        if (in_array($extension, $accepted_type)) {
            if ($fileSize < 5000000) {
                $newFileName = uniqid('img_', true) . "." . $extension;
                $fileDestination = '../photos/profile/' . $newFileName;
                move_uploaded_file($fileTmpName, $fileDestination);
            } 
        } 
    }

    $query = "UPDATE customers SET username = ?, email = ?, profile = ? WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $params = [$user, $email, $newFileName, $email1];
    $stmt->execute($params);
}

header("Location: ./account.php?update=yes");

?>