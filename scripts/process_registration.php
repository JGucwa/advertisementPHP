<?php
    $conn = new mysqli('localhost','root','','projekt');

    if(isset($_POST['isUser']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstname = $_POST['user_firstname'];
            $surname = $_POST['user_surname'];
            $birthdate = $_POST['user_birthdate'];
            $number = $_POST['user_number'];
            $email = $_POST['user_email'];
            $password1 = $_POST['user_password'];
            $password2 = $_POST['user_password2'];
        
            $found_elements = array();
    
        for ($i = 0; $i < 10; $i++) {
            $nam = 'link_' . ($i + 1);
    
            if (isset($_POST[$nam])) {
                $element = $_POST[$nam];
                $found_elements[] = $element;
            }
        }
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0 || $password1 != $password2) {

            echo "<script>window.history.back();</script>";
        } else {
    
            echo "Podany email nie istnieje w bazie danych.";
        }
        $sql = "INSERT INTO `user`(`Firstname`, `Surname`, `birth_date`, `email`, `password`, `number`, `Admin`) VALUES ('$firstname','$surname','$birthdate','$number','email','$password1',false)";
    
        $result = $conn->query($sql);

        header("refresh:3;url=../index.php");
        }
    }
    else
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['company_name'];
            $nip = $_POST['company_nip'];
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
            
            echo "<script>window.history.back();</script>";
        } else {
    
            echo "Podany email nie istnieje w bazie danych.";
        }
        $sql = "INSERT INTO `company`(`email`, `password`, `nip`, `name`, `localization`, `logo`, `description`, `Verified`)
         VALUES ('$email','$password1','$nip','$name','','','','false')";
    
        $result = $conn->query($sql);
    }
    
    header("refresh:3;url=../index.php");

    }
    $conn->close();
?>