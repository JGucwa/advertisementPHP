<?php
    $conn = new mysqli('localhost','root','','projekt');

    if(isset($_POST['isUser']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
        
        $sql = "SELECT user_id FROM user WHERE email = '$email' AND password = $password";

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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
        
        $sql = "SELECT company_id FROM company WHERE email = '$email' AND password = $password";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

                session_start();

                $_SESSION['CompanyId'] = $row["company_id"];
            }
  
            header("refresh:0;url=../index.php");
            
        } else {

            echo "<script>window.history.back();</script>";
        }

        }
    }
    $conn->close();
?>