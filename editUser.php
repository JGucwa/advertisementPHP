<?php
    session_start();

    if(!isset($_SESSION['Admin']))
    {
        header("refresh:0;url=index.php");
    }
    

?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <style>
        .btn
        {
            margin: 10px;
        }
        td
        {
            width: 120px;
        }
    </style>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-white fixed-top shadow">
                <div class="container">
                    <a class="navbar-brand text-black" href="index.php">Logo</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </header>
        <br><br><br>
        <section>
            <table>
                <th><td>ID</td><td>IMIE</td><td>NAZWISKO</td><td>DATA URODZENIA</td><td>NUMER</td><td>ADRES</td><td>STANOWISKO</td><td>OPIS</td><td>WERYFIKACJA</td></th>
                    <?php
                        $conn = new mysqli('localhost','root','','projekt');

                        if(isset($_GET['id']))
                        {
                            $sql = "SELECT * FROM user WHERE user_id = '{$_GET['id']}'";
                        }
                        else
                        {
                            return;
                        }
                            

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0)
                        {
                            $row = $result->fetch_assoc();
                            echo "<form action='scripts/process_update_account.php' method = 'post'>";
                            echo "<tr>
                            <td></td><td><input type='number' value = '".$row['user_id']."'></td> 
                            <td><input type='text' value = '".$row['firstname']."'></td> 
                            <td><input type='text' value = '".$row['surname']."'></td> 
                            <td><input type='date' value = '".$row['birth_date']."'></td> 
                            <td><input type='number' value = '".$row['number']."'></td> 
                            <td><input type='text' value = '".$row['address']."'></td> 
                            <td><input type='text' value = '".$row['actual_position']."'></td> 
                            <td><input type='text' value = '".$row['position_description']."'></td> 
                            <td><input type='checkbox' value = '".$row['Verified']."'></td></tr>
                            <input type = 'submit' value = 'Edytuj'";
                        }
                    ?>
                </table>
        </section>
    </body>
    
</html>
