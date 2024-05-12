<?php
    session_start();

    if(!isset($_SESSION['UserId']))
        echo "<script>window.history.back();</script>";

    $conn = new mysqli('localhost','root','','projekt');

    $sql = "SELECT * FROM user_applications WHERE user_id = '{$_SESSION['UserId']}' AND offer_id = '{$_GET['offerId']}'";

    $result = $conn->query($sql);

    if($result->num_rows == 0)
    {
        $sql = "INSERT INTO user_applications (offer_id,user_id)
        VALUES ('{$_GET['offerId']}','{$_SESSION['UserId']}')";
    
        $result = $conn->query($sql);
    
        $activity = "INSERT INTO offer_activity (offer_id,user_id,type) 
            VALUES ('{$_GET['offerId']}','{$_SESSION['UserId']}','1')";
    
        $result = $conn->query($activity);
    
        echo "<script>window.history.back();</script>";
    }

    echo "<script>window.history.back();</script>";
    


?>