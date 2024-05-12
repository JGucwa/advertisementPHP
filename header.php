<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
  
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-white fixed-top shadow">
        <div class="container">
            <a class="navbar-brand text-black" href="index.php">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Oferty pracy</a>
                    </li>
                    <li class="nav-item">
                        <a href="offerAdd.php" class="nav-link text-black" href="#">Dodaj ofertę</a>
                    </li>
                    <li class="nav-item">
                    <?php
                        session_start();

                        if(isset($_SESSION['UserId']))
                        {
                            echo <<< tab
                            <a href="account.php?isUser">
                                <button type="button" class="btn mt-1 btn-danger btn-sm">Moje Konto</button>
                            </a>
                        tab;
                        }
                        else
                        {
                            if(isset($_SESSION['CompanyId']))
                            {
                            echo <<< tab
                                <a href="account.php">
                                    <button type="button" class="btn mt-1 btn-danger btn-sm">Moja Firma</button>
                                </a>
                            tab;
                            }
                            else
                            {
                                echo <<< tab
                                <a href="RegisterLogin.php">
                                    <button type="button" class="btn mt-1 btn-danger btn-sm">Zaloguj się</button>
                                </a>
                                tab;
                            }

                        }

                    ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
