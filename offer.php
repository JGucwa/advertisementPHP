<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Szczegóły Oferty Pracy</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    .bg-image {
      background-image: url('images/jobbg.png');
      background-size: cover;
      background-position: center;
      color: #fff;
    }

    section {
      padding: 20px 0;
    }

    .job-details {
      background-color: #343a40;
      color: #fff;
      border-radius: 10px;
      padding: 30px;
      margin-bottom: 20px;
    }
    .job-details img{
      width: 50px;
      border-radius: 8px; 
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    .job-details ul li {
      margin-bottom: 10px;
      position: relative;
    }

    ul li::before {
      content: '\2713';
      color: white;
      font-size: 1.2em;
      position: absolute;
      left: -1em;
    }

    .apply-block {
      background-color: #343a40;
      color: #fff;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }

    footer {
      background-color: #343a40;
      color: #fff;
    }
  </style>
</head>
<body>
  
  <?php include 'header.php'; 
    $conn = new mysqli('localhost', 'root', '', 'projekt');
    
    $sql = "SELECT * FROM offer WHERE offer_id = '{$_GET['offer_id']}'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
  ?>

  <header class="bg-image text-center py-5 shadow">
    <div class="container">
      <h1 class="display-4">
        <?php echo $row['position_name']; ?></h1>
      <p class="lead"><?php $row['position_name'] ?></p>
    </div>
  </header>

  <section class="py-5 shadow">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
            <div class="job-details row shadow">
                <div class="col-md-6">
                    <div class="block">
                        <p><img src="images/localization.png" alt="lokalizacja" class="shadow">
                        <?php echo $row['localization']; ?></p>
                    </div>
                    <div class="block">
                        <p><img src="images/agreement.png" alt="potwierdzenie" class="shadow">
                        <?php echo $row['type_of_contract']; ?></p>
                    </div>
                    <div class="block">
                        <p><img src="images/level.png" alt="poziom" class="shadow">
                      poziom</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block">
                        <p><img src="images/expired.png" alt="wygasa" class="shadow">
                      wygasa</p>
                    </div>
                    <div class="block">
                        <p><img src="images/job.png" alt="praca" class="shadow">
                      praca</p>
                    </div>
                    <div class="block">
                        <p><img src="images/type.png" alt="typ" class="shadow">
                      typ</p>
                    </div>
                </div>               
              </div>
              

          <div class="job-details row shadow">
            <h2 class="mb-4">Wymagania</h2>
            <ul>
              <li>Doświadczenie w dziedzinie marketingu co najmniej 3 lata</li>
              <li>Znajomość narzędzi analitycznych, takich jak Google Analytics</li>
              <li>Dobra znajomość trendów rynkowych i konkurencji</li>
              <li>Umiejętność zarządzania projektami marketingowymi</li>
              <li>Kreatywność i innowacyjne podejście do problemów</li>
            </ul>
          </div>

          <div class="job-details row shadow">
            <h2 class="mb-4">Obowiązki</h2>
            <ul>
              <li>Doświadczenie w dziedzinie marketingu co najmniej 3 lata</li>
              <li>Znajomość narzędzi analitycznych, takich jak Google Analytics</li>
              <li>Dobra znajomość trendów rynkowych i konkurencji</li>
              <li>Umiejętność zarządzania projektami marketingowymi</li>
              <li>Kreatywność i innowacyjne podejście do problemów</li>
            </ul>
          </div>


          <div class="job-details row shadow">
            <h2 class="mb-4">Co oferujemy</h2>
            <ul>
              <li>Doświadczenie w dziedzinie marketingu co najmniej 3 lata</li>
              <li>Znajomość narzędzi analitycznych, takich jak Google Analytics</li>
              <li>Dobra znajomość trendów rynkowych i konkurencji</li>
              <li>Umiejętność zarządzania projektami marketingowymi</li>
              <li>Kreatywność i innowacyjne podejście do problemów</li>
            </ul>
          </div>
          <div class="job-details row shadow">
            <h2 class="mb-4">Nazwa firmy</h2>
                Opis firmy
          </div>
        </div>

        <div class="col-md-4">
          <div class="apply-block shadow">
            <h2 class="mb-4">Aplikuj Teraz</h2>
            <p>Telefon kontaktowy: 123 456 789</p>
            <a href="#" class="btn btn-primary mt-3">Aplikuj szybko</a>
          </div>
          <div class="apply-block shadow">
            <h2 class="mb-4">Podobne oferty</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
    } else {
        echo "Brak wyników dla podanego ID oferty.";
    }

    $conn->close();
  ?>

  <footer class="footer">
    <div class="container">
        <p>&copy; 2023 Jakub Gucwa</p>
    </div>
    </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
