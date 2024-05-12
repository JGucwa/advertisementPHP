<?php
    $conn = new mysqli('localhost', 'root', '', 'projekt');
    
    $sql = "DELETE FROM offer WHERE offer_id = '{$_GET['offer_id']}'";

    $result = $conn->query($sql);

    header("refresh:0;url=../index.php");
?>