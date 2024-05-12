<?php
    session_start();

    $conn = new mysqli('localhost','root','','projekt');

    if(isset($_POST['user']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_SESSION['UserId'];

            if(isset($_POST['user']))
                $id = $_POST['user'];
            $firstname = $_POST['user_firstname'];
            $surname = $_POST['user_surname'];
            $email = $_POST['user_email'];
            $number = $_POST['user_number'];
            $password = $_POST['user_password'];
            $birthdate = $_POST['user_birthdate'];
            $address = $_POST['user_address'];
            $position = $_POST['user_actualposition'];
            $position_description = $_POST['user_positiondescription'];

            $sql = "SELECT * FROM user
                WHERE (email = '$email') AND 'user_id' <> '$id'";
            $result = $conn->query($sql);
    
            if ($result->num_rows == 0) {
            
                echo "<script>window.history.back();</script>";
            } 
            else {

                $sql = "UPDATE `user`
                    SET firstname = '$firstname', surname = '$surname', email='$email',number = '$number', password='$password', address = '$address', birth_date = '$birthdate',
                     actual_position = '$position', position_description = '$position_description'
                    WHERE user_id = '$id'";

                $result = $conn->query($sql);

                $sql = "DELETE FROM `user_experience` WHERE `user_id` = '$id'";

                $result = $conn->query($sql);

                for ($i = 0; $i < 10; $i++) {
                    $nam = 'experience_' . ($i + 1);
        
                        if (isset($_POST[$nam])) {
                            $element = $_POST[$nam];

                            $sql = "INSERT INTO `user_experience`(`user_id`, `text`)
                            VALUES ('$id','$element')";

                            $result = $conn->query($sql);
                    }
                    }
                $sql = "DELETE FROM `user_education` WHERE `user_id` = '$id'";

                $result = $conn->query($sql);

                for ($i = 0; $i < 10; $i++) {
                    $nam = 'education_' . ($i + 1);
        
                        if (isset($_POST[$nam])) {
                            $element = $_POST[$nam];

                            $sql = "INSERT INTO `user_education`(`user_id`, `text`)
                            VALUES ('$id','$element')";

                            $result = $conn->query($sql);
                    }
                    }
                $sql = "DELETE FROM `user_skills` WHERE `user_id` = '$id'";

                $result = $conn->query($sql);

                for ($i = 0; $i < 10; $i++) {
                    $nam = 'skills_' . ($i + 1);
        
                        if (isset($_POST[$nam])) {
                            $element = $_POST[$nam];

                            $sql = "INSERT INTO `user_skills`(`user_id`, `text`)
                            VALUES ('$id','$element')";

                            $result = $conn->query($sql);
                    }
                    }
                $sql = "DELETE FROM `user_courses` WHERE `user_id` = '$id'";

                $result = $conn->query($sql);

                for ($i = 0; $i < 10; $i++) {
                    $nam = 'courses_' . ($i + 1);
        
                        if (isset($_POST[$nam])) {
                            $element = $_POST[$nam];

                            $sql = "INSERT INTO `user_courses`(`user_id`, `text`)
                            VALUES ('$id','$element')";

                            $result = $conn->query($sql);
                    }
                    }
                $sql = "DELETE FROM `user_links` WHERE `user_id` = '$id'";

                $result = $conn->query($sql);

                for ($i = 0; $i < 10; $i++) {
                    $nam = 'links_' . ($i + 1);
        
                        if (isset($_POST[$nam])) {
                            $element = $_POST[$nam];

                            $sql = "INSERT INTO `user_links`(`user_id`, `text`)
                            VALUES ('$id','$element')";

                            $result = $conn->query($sql);
                    }
                }

                if(isset($_POST['user']))
                    header("refresh:0;url=../admin_users.php");
                else
                    header("refresh:0;url=../index.php");
            }
        }
    }
    if(isset($_POST['company']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_SESSION['CompanyId']))
                $id = $_SESSION['CompanyId'];
            if(isset($_POST['company']))
                $id = $_POST['company'];
            $name = $_POST['company_name'];
            $nip = $_POST['company_nip'];
            $email = $_POST['company_email'];
            $password = $_POST['company_password'];
            $localization = $_POST['company_location'];
            $description = $_POST['company_description'];

            $sql = "SELECT * FROM company 
                WHERE company_id = '$id'";
            $result = $conn->query($sql);
    
            if ($result->num_rows == 0) {
            
                echo "<script>window.history.back();</script>";
            } 
            else {
    
                $sql = "UPDATE company
                    SET email='$email', password='$password', nip='$nip', name='$name',
                        localization='$localization', description='$description'
                    WHERE company_id = '$id'";

                $result = $conn->query($sql);

                $sql = "DELETE FROM `company_links` WHERE `company_id` = '$id'";

                $result = $conn->query($sql);

                for ($i = 0; $i < 10; $i++) {
                    $nam = 'link_' . ($i + 1);
        
                        if (isset($_POST[$nam])) {
                            $element = $_POST[$nam];

                            $sql = "INSERT INTO `company_links`(`company_id`, `value`)
                            VALUES ('$id','$element')";

                            $result = $conn->query($sql);
                    }
                    }
                if(isset($_POST['company']))
                    header("refresh:0;url=../admin_companies.php");
                else
                    header("refresh:0;url=../index.php");
            }
        }
 
    }
    $conn->close();
?>