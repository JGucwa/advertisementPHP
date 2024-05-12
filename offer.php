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
      background-color: white;
      border-radius: 10px;
      padding: 30px;
      margin-bottom: 20px;
    }
    .job-details img{
      width: 50px;
      border-radius: 8px; 
    }
    .manage-panel {
      background-color: white;
    }
    .manage-panel img{
      width: 20px;
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
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }

    footer {
      background-color: white;
    }
  </style>
</head>
<body>
  
  <?php include 'header.php'; 

    session_start();
    $conn = new mysqli('localhost', 'root', '', 'projekt');

    $userId = -1;

    if(isset($_SESSION['UserId']))
      $userId = $_SESSION['UserId'];
    if(!isset($_SESSION['CompanyId']))
    {
      $activity = "INSERT INTO offer_activity (offer_id,user_id,type) 
      VALUES ('{$_GET['offer_id']}','$userId','0')";

      $result = $conn->query($activity);
    }
    

    $activity = "SELECT COUNT(id) as views FROM offer_activity WHERE type = '0' AND offer_id = '{$_GET['offer_id']}'";

    $result = $conn->query($activity);

    $views = $result->fetch_assoc();

    $activity = "SELECT COUNT(id) as apply FROM offer_activity WHERE type = '1' AND offer_id = '{$_GET['offer_id']}'";

    $result = $conn->query($activity);

    $apply = $result->fetch_assoc();

    $sql = "SELECT * FROM offer WHERE offer_id = '{$_GET['offer_id']}'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentOfferId = $row['offer_id'];
  ?>

  <header class="bg-image text-center py-5 shadow">
    <div class="container">
      <h1 class="display-4">
        <?php echo $row['position_name']; ?></h1>
      <p class="lead"><?php $row['position_name'] ?></p>
    </div>
  </header>

  <?php

  if($row['company_id'] == $_SESSION["CompanyId"] && isset($_SESSION["CompanyId"]))
  {
    echo <<< tab
      <section class="shadow">
          <div class="container manage-panel">
            <div class="row">
              <div class='col-md-6'>
                <div class="row">
                  <div class='col-md-6'>
                    <div class="block">
                      <p><img alt="lokalizacja" class="shadow">
    tab;
                        echo $views['views'];
    echo <<< tab
                        </p>
                    </div>
                  </div>
                  <div class='col-md-6'>
                    <div class="block">
                      <p><img alt="lokalizacja" class="shadow">
    tab;
                        echo $apply['apply'];
    echo <<< tab
                        </p>
                    </div>
                  </div>
                </div> 
              </div>
    tab;
    echo "<a href = 'offer_details.php?offer_id=".$row['offer_id']."' class='col-md-2 btn btn-primary'>Szczegoly</a>";
    echo <<< tab
              <div class='col-md-2 btn btn-primary'>Edytuj</div>
    tab;
    echo  "<a href='scripts/process_delete_offer.php?offer_id=".$row['offer_id']."' class='col-md-2 btn btn-danger'>Usun</a>";
    echo <<< tab
              </div>
          </div>
        </section>

    tab;
  }
  
  ?>
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
              <?php
                $sql = "SELECT text FROM offer_requirements WHERE offer_id = '$currentOfferId'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc())
                  {
                      echo "<li>".$row['text']."</li>";
                  }
                }
              ?>
            </ul>
          </div>

          <div class="job-details row shadow">
            <h2 class="mb-4">Obowiązki</h2>
            <ul>
            <?php
                $sql = "SELECT text FROM offer_duties WHERE offer_id = '$currentOfferId'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc())
                  {
                      echo "<li>".$row['text']."</li>";
                  }
                }
              ?>
            </ul>
          </div>


          <div class="job-details row shadow">
            <h2 class="mb-4">Co oferujemy</h2>
            <ul>
            <?php
                $sql = "SELECT text FROM offer_benefits WHERE offer_id = '$currentOfferId'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc())
                  {
                      echo "<li>".$row['text']."</li>";
                  }
                }

                $sql = "SELECT * FROM company JOIN offer ON company.company_id = offer.company_id";

                $result = $conn->query($sql);

                $row = $result->fetch_assoc();

                echo "
                    </ul>
                      </div>
                        <div class='job-details row shadow'>
                          <h2 class='mb-4'>"."Opis"."</h2>
                            ".$row['description']."
                        </div>
                      </div>
          
                      <div class='col-md-4'>
                        <div class='apply-block shadow'>
                          <h2 class='mb-4'>Aplikuj Teraz</h2>
                          <p>Email kontaktowy: ".$row['email']."</p>
                ";
                
            echo "<a href='scripts/process_offer_application.php?offerId=".$row['offer_id']."' class='btn btn-primary mt-3'>Aplikuj szybko</a>";
        ?>
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
