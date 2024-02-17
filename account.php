<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profil Użytkownika</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    header {
      background-color: #343a40;
      padding: 20px 0;
    }

    h1, h2, h3 {
      color: black;
    }

    .container {
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      padding: 20px;
      margin-top: 20px;
    }

    .list-group-item {
      background-color: #f8f9fa;
      border: none;
      border-radius: 4px;
    }

    .list-group-item ul {
      list-style-type: none;
      padding-left: 0;
    }

    .list-group-item li {
      border-bottom: 1px solid #d1d1d1;
      padding: 8px 0;
    }
    .no-underline {
        text-decoration: none !important;
    }
  </style>
</head>
<body>
  <header class="text-center bg-white">
    <h1>Profil Użytkownika</h1>
  </header>
  <section class="container">
    <div class="row">
      <div class="col-5 col-md-10">
        <button type="button" class="btn mt-1 btn-dark btn-sm" onClick="Back()">Powrót</button>
      </div>
      <div class="col-7 col-md-2">
        <?php
          if(isset($_SESSION['UserId']))
          {
            echo  '<a href="accountEdit.php?isUser&isEdit">';
          }
          else
          {
            echo  '<a href="accountEdit.php?isEdit">';
          }
        ?>
          <button type="button" class="btn mt-1 btn-dark btn-sm">Edytuj dane</button>
        </a>
        <a href="scripts/process_logout.php">
          <button type="button" class="btn mt-1 btn-dark btn-sm">Wyloguj</button>
        </a>
      </div>
    </div>
  </section>     
<?php
  if(isset($_GET['isEdit']))
  {
    if(isset($_SESSION['UserId']))
    {
      header("refresh:0;url=accountEdit.php?isUser&isEdit");
    }
    else
    {
      header("refresh:0;url=accountEdit.php?isEdit");
    }    
  }
  

  $conn = new mysqli('localhost','root','','projekt');

  session_start();

  if(isset($_SESSION['UserId']))
  {

    $sql = "SELECT * FROM user";
  
    $result = $conn->query($sql);
  
    while($row = $result->fetch_assoc()) {

      echo <<< tab
          <section class="container">
          <h2 class="mb-4">Dane Osobowe</h2>
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-3">
                  <strong>Imię:</strong>
                </div>
                <div class="col-md-9">
                  {$row["firstname"]}
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <strong>Nazwisko:</strong>
                </div>
                <div class="col-md-9">
                  {$row["surname"]}
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <strong>Data urodzenia:</strong>
                </div>
                <div class="col-md-9">
                  {$row["birth_date"]}
                </div>
              </div>             
            </div>
            <div class="col-md-6">
              <p><strong>Email:</strong><a>{$row["email"]}</a></p>
              <p><strong>Telefon:</strong><a>{$row["number"]}</a></p>
              <p><strong>Adres:</strong><a>{$row["address"]}</a></p>
            </div>
          </div>
        </section>
        <section class="container mt-4">
          <h2 class="mb-4">Informacje o tobie</h2>
              <p><strong>O tobie:</strong></p>
              <p><strong>Stanowisko:</strong></p>
        </section>
        <section class="container mt-4">
          <h2 class="mb-4">Moja kariera</h2>
          <ul class="list-group">
            <li class="list-group-item">
              <strong>Języki:</strong>
              <ul>
                <li></li>
              </ul>
            </li>
            <li class="list-group-item">
              <strong>Doświadczenie:</strong>
              <ul>
                <li></li>
              </ul>
            </li>
            <li class="list-group-item">
              <strong>Umiejętności:</strong>
              <ul>
                <li></li>
              </ul>
            </li>
            <li class="list-group-item">
              <strong>Edukacja:</strong>
              <ul>
                <li></li>
              </ul>
            </li>
            <li class="list-group-item">
              <strong>Kursy:</strong>
              <ul>
                <li></li>
              </ul>
            </li>
            <li class="list-group-item">
              <strong>Linki:</strong>
              <ul>
                <li></li>
              </ul>
            </li>
          </ul>
        </section>

      tab;

    }
  }
  else
  {
    if(isset($_SESSION['CompanyId']))
    {
        $sql = "SELECT * FROM company WHERE company_id = '{$_SESSION['CompanyId']}'";
         
        $result = $conn->query($sql);
      
        while($row = $result->fetch_assoc()) 
        {
          echo <<< tab
              <section class="container">
              <h2 class="mb-4">Dane Firmy</h2>
              <div class="row">
                <div class="col-md-3">
                  <div class="row">
                    <div class="col-md-12">
                      <img width = "100" src = '{$row["logo"]}'/>
                    </div>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-3">
                      <strong>Nazwa:</strong>
                    </div>
                    <div class="col-md-9">
                      {$row["name"]}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <strong>NIP:</strong>
                    </div>
                    <div class="col-md-9">
                      {$row["nip"]}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <strong>Email:</strong>
                    </div>
                    <div class="col-md-9">
                      {$row["email"]}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <strong>Lokalizacja:</strong>
                    </div>
                    <div class="col-md-9">
                      {$row["localization"]}
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section class="container mt-4">
              <h2 class="mb-4">Opis</h2>
                  <p>{$row["description"]}</p>
            </section>
            <section class="container mt-4">
              <h2 class="mb-4">Moja kariera</h2>
              <ul class="list-group">
                <li class="list-group-item">
                  <strong>Linki:</strong>
                  <ul>                 
          tab;
            $sql = "SELECT * FROM company_links WHERE company_id = {$row['company_id']}";
      
            $result = $conn->query($sql);
      
            while($row = $result->fetch_assoc())
            {
              echo "<li><a href = '{$row['value']}' class = 'text-muted no-underline'>{$row['value']}</a></li>";
            }
            echo <<< tab
                  </ul>
                </li>
                <li class="list-group-item">
                  <strong>Ogłoszenia:</strong>
                  <ul>
                    <li></li>
                  </ul>
                </li>
                <li class="list-group-item">
                  <strong>Wiadomości:</strong>
                  <ul>
                    <li></li>
                  </ul>
                </li>
              </ul>
            </section>
    
          tab;
    
        }
    }
    else
    {
      header("refresh:0;url=index.php");
    }
  }
  $conn->close();
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">

      function Back()
      {
        window.history.back();
      }
  </script>
</body>
</html>
