<?php
    $conn = new mysqli('localhost','root','','projekt');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['company_name'];
        $nip = $_POST['company_nip'];
        $description = $_POST['company_description'];
        $email = $_POST['company_email'];
        $password1 = $_POST['company_password'];
        $password2 = $_POST['company_password2'];
    
        $found_elements = array();

    for ($i = 0; $i < 10; $i++) {
        $nam = 'link_' . ($i + 1);

        if (isset($_POST[$nam])) {
            $element = $_POST[$nam];
            $found_elements[] = $element;
        }
    }
    $sql = "SELECT * FROM company WHERE email = '$email' OR nip = '$nip'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0 || $password1 != $password2) {

        setTimeout(function(){
            window.history.back();
          }, 0);
    } else {

        echo "Podany email nie istnieje w bazie danych.";
    }
    $sql = "INSERT INTO `company`(`email`, `password`, `nip`, `name`, `localization`, `logo`, `description`, `Verified`)
     VALUES ('$email','$password1','$nip','$name','','','$description','false')";

    $result = $conn->query($sql);

    header("refresh:3;url=../index.php");

    }
    $conn->close();
?>