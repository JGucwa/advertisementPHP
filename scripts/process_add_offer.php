<?php
    session_start();

    $conn = new mysqli('localhost','root','','projekt');

    if(isset($_SESSION['CompanyId']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $position_name = $_POST['position_name'];
            $position_level = $_POST['position_level'];
            $type_of_contract = $_POST['type_of_contract'];
            $employment = $_POST['employment'];
            $type_of_job = $_POST['type_of_job'];
            $salary = $_POST['salary'];
            $days = $_POST['days'];
            $startHour = $_POST['startHour'];
            $endHour = $_POST['endHour'];

            $currentDateTime = date("Y-m-d H:i:s");

            $currentDate = new DateTime();
            $expiredDate = clone $currentDate;
            $expiredDate->modify('+30 days');

            $expiredDateTime = $expiredDate->format('Y-m-d H:i:s');

            mysqli_query($conn, "INSERT INTO offer (company_id,position_name, position_level, type_of_contract,employment,type_of_job,salary,days,Add_date,expired) 
                VALUES ({$_SESSION['CompanyId']},'$position_name','$position_level','$type_of_contract','$employment','$type_of_job','$salary','$days','$currentDateTime','$expiredDateTime')");

            $last_id = mysqli_insert_id($conn);

            $sql = "SELECT MAX('offer_id') FROM offer";

            $result = $conn->query($sql);

            for ($i = 0; $i < 10; $i++) {
                $nam = 'requirements_' . ($i + 1);
        
                if (isset($_POST[$nam])) {
                    $element = $_POST[$nam];

                    $sql = "INSERT INTO `offer_requirements`(`offer_id`, `text`)
                    VALUES ('$last_id','$element')";

                    $result = $conn->query($sql);
                }
            }
            for ($i = 0; $i < 10; $i++) {
                $nam = 'duties_' . ($i + 1);
        
                if (isset($_POST[$nam])) {
                    $element = $_POST[$nam];

                    $sql = "INSERT INTO `offer_duties`(`offer_id`, `text`)
                    VALUES ('$last_id','$element')";

                    $result = $conn->query($sql);
                }
            }
            for ($i = 0; $i < 10; $i++) {
                $nam = 'benefits_' . ($i + 1);
        
                if (isset($_POST[$nam])) {
                    $element = $_POST[$nam];

                    $sql = "INSERT INTO `offer_benefits`(`offer_id`, `text`)
                    VALUES ('$last_id','$element')";

                    $result = $conn->query($sql);
                }
            }
        }
        header("refresh:0;url=../index.php");
    }
    else
    {
        header("refresh:0;url=../index.php");
    }
    $conn->close();
?>