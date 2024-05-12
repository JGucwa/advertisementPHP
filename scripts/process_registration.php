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
                   
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0 || $password1 != $password2) {

            echo "<script>window.history.back();</script>";
        } else {
    
            $sql = "INSERT INTO `user`(`Firstname`, `Surname`, `birth_date`, `email`, `password`, `number`, `Admin`) VALUES ('$firstname','$surname','$birthdate','$email','$password1','$number',false)";
    
            $result = $conn->query($sql);

            $sql = "SELECT user_id FROM user WHERE email = '$email'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                
                session_start();

                $_SESSION['UserId'] = $row["user_id"];
            }

    
            header("refresh:0;url=../account.php?isUser?isEdit");
        }

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
        
        $sql = "SELECT * FROM company WHERE email = '$email' OR nip = '$nip'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0 || $password1 != $password2) {
            
            echo "<script>window.history.back();</script>";
        } else {
            

            $sql = "INSERT INTO `company`(`email`, `password`, `nip`, `name`, `localization`, `logo`, `description`, `Verified`)
            VALUES ('$email','$password1','$nip','$name','','','','false')";
       
            $result = $conn->query($sql);

            $sql = "SELECT company_id FROM company WHERE email = '$email'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
    
                for ($i = 0; $i < 10; $i++) {
                $nam = 'link_' . ($i + 1);
    
                if (isset($_POST[$nam])) {
                    $element = $_POST[$nam];
                    $sql = "INSERT INTO `company_links`(`company_id`, `value`)
                    VALUES ('{$row['company_id']}','$element')";

                    $result = $conn->query($sql);
                }
                }
                
                session_start();

                $_SESSION['CompanyId'] = $row["company_id"];
            }

           header("refresh:0;url=../account.php?isEdit");
        }
 
    }
    


    }
    $conn->close();
?>