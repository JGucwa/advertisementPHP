<?php
    $conn = new mysqli('localhost','root','','projekt');

    if(isset($_POST['isUser']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
        
        $sql = "SELECT 'user_id' FROM user WHERE email = '$email' AND password = $password";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

                session_start();

                $_SESSION['UserId'] = $row["user_id"];
            }
  
            header("refresh:0;url=../index.php");
            
        } else {

            echo "<script>window.history.back();</script>";
        }

        }
    }
    else
    {
        
        $sql = "SELECT * FROM company WHERE email = '$email' OR nip = '$nip'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0 || $password1 != $password2) {
            
            echo "<script>window.history.back();</script>";
        } else {
    
            $sql = "INSERT INTO `company`(`email`, `password`, `nip`, `name`, `localization`, `logo`, `description`, `Verified`)
            VALUES ('$email','$password1','$nip','$name','','','','false')";
       
           $result = $conn->query($sql);

           $sql = "SELECT company_id FROM company WHERE email = $email";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                
                session_start();

                $_SESSION['CompanyId'] = $row["company_id"];
            }

           header("refresh:3;url=../account.php");
        }
 
    }
    $conn->close();
?>