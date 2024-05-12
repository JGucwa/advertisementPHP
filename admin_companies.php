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
            <form method="post" action = "admin_companies.php">
                <input type = "text" name="filter">
                <input type = "submit" value = "szukaj"/>
            </form>
            <table>
                <th><td>ID</td><td>NAZWA</td><td>NIP</td><td>LOKALIZACJA</td></th>
                    <?php
                        $conn = new mysqli('localhost','root','','projekt');

                        $sql = "SELECT company_id,name,nip,localization FROM company";

                        if(isset($_POST['filter']))
                        {
                            $sql = "SELECT company_id,name,nip,localization FROM company WHERE company_id LIKE '{$_POST['filter']}' OR name LIKE '%{$_POST['filter']}%' OR nip LIKE '%{$_POST['filter']}%' OR localization LIKE '%{$_POST['filter']}%'";
                        }
                            

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0)
                        {
                            while ($row = $result->fetch_assoc())
                            {
                                echo "<tr><td></td><td>".$row['company_id']."</td> <td>".$row['name']."</td> <td>".$row['nip']."</td> <td>".$row['localization']."</td><td><a href = 'accountEdit.php?isEdit=1&company_id=".$row['company_id']."'>Edytuj</a></td></tr>";
                            }
                        }
                    ?>
                </table>
        </section>
    </body>
    
</html>
