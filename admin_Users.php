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
            <form method="post" action = "admin_users.php">
                <input type = "text" name="filter">
                <input type = "submit" value = "szukaj"/>
            </form>
            <table>
                <th><td>ID</td><td>IMIE</td><td>NAZWISKO</td><td>DATA URODZENIA</td></th>
                    <?php
                        $conn = new mysqli('localhost','root','','projekt');

                        $sql = "SELECT user_id,firstname,surname,birth_date FROM user";

                        if(isset($_POST['filter']))
                        {
                            $sql = "SELECT user_id,firstname,surname,birth_date FROM user WHERE user_id LIKE '{$_POST['filter']}' OR firstname LIKE '%{$_POST['filter']}%' OR surname LIKE '%{$_POST['filter']}%'";
                        }
                            

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0)
                        {
                            while ($row = $result->fetch_assoc())
                            {
                                echo "<tr><td></td><td>".$row['user_id']."</td> <td>".$row['firstname']."</td> <td>".$row['surname']."</td> <td>".$row['birth_date']."</td><td><a href = 'accountEdit.php?isEdit=1&user_id=".$row['user_id']."'>Edytuj</a></td></tr>";
                            }
                        }
                    ?>
                </table>
        </section>
    </body>
    
</html>
