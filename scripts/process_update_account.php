<?php
    session_start();

    $conn = new mysqli('localhost','root','','projekt');

    if(isset($_POST['isUser']))
    {

    }
    else
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['company_name'];
            $nip = $_POST['company_nip'];
            $email = $_POST['company_email'];
            $password = $_POST['company_password'];
            $localization = $_POST['company_location'];
            $description = $_POST['company_description'];

            $sql = "SELECT * FROM company 
                WHERE (email = '$email' OR nip = '$nip') AND company_id <> '{$_SESSION['CompanyId']}'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
            
                echo "<script>window.history.back();</script>";
            } 
            else {
    
                $sql = "UPDATE company
                    SET email='$email', password='$password', nip='$nip', name='chujowo',
                        localization='$localization', description='$description'
                    WHERE company_id = '{$_SESSION['CompanyId']}'";

                $result = $conn->query($sql);

                $sql = "DELETE FROM `company_links` WHERE `company_id` = {$_SESSION['CompanyId']}";

                $result = $conn->query($sql);

                for ($i = 0; $i < 10; $i++) {
                    $nam = 'link_' . ($i + 1);
        
                        if (isset($_POST[$nam])) {
                            $element = $_POST[$nam];

                            $sql = "INSERT INTO `company_links`(`company_id`, `value`)
                            VALUES ('{$_SESSION['CompanyId']}','$element')";

                            $result = $conn->query($sql);
                    }
                    }
                 header("refresh:0;url=../index.php");
            }
        }
 
    }
    $conn->close();
?>