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
      color: #fff;
      padding: 20px 0;
    }

    h1, h2, h3 {
      color: aqua;
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
  </style>
</head>
<body>

  <header class="text-center">
    <h1>Profil Użytkownika</h1>
  </header>
  <section class="container">
    <div class="row">
        <div class="col-5 col-md-10">
          <button type="button" class="btn mt-1 btn-secondary btn-sm">Powrót</button>
        </div>
        <div class="col-7 col-md-2">
            <button type="button" class="btn mt-1 btn-success btn-sm ">Edytuj dane</button>
            <a href="scripts/process_logout.php">
              <button type="button" class="btn mt-1 btn-danger btn-sm">Wyloguj</button>
            </a>
        </div>
    </div>

  </section>
  <section class="container">
    <h2 class="mb-4">Dane Osobowe</h2>
    <div class="row">
      <div class="col-md-6">
        <p><strong>Imię:</strong> </p>
        <p><strong>Nazwisko:</strong> </p>
        <p><strong>Data urodzenia:</strong> </p>
      </div>
      <div class="col-md-6">
        <p><strong>Email:</strong> </p>
        <p><strong>Telefon:</strong> </p>
        <p><strong>Adres:</strong> </p>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
