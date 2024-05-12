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
            <div>
                <div>
                    <div class='col-md-2 btn btn-primary'>Oferty</div><br>
                    <a href = "admin_Users.php"><div class='col-md-2 btn btn-primary'>Uzytkownicy</div></a><br>
                    <a href = "admin_Companies.php"><div class='col-md-2 btn btn-primary'>Pracodawcy</div></a><br>
                </div>
            </div>
        </section>
    </body>
    
</html>
